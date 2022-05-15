<?php

include('header.php');

include('db_conn.php');
if (isset($_GET["no-result"]) && !empty($_GET['ID'])) {
    $queryb = 'SELECT * FROM bank WHERE ID  = "' . mysqli_real_escape_string($conn, $_GET['ID']) . '" LIMIT 1';
    $resultb = mysqli_query($conn, $queryb) or die(mysqli_error($conn));
    if (mysqli_num_rows($resultb) > 0) {
        $k = mysqli_fetch_array($resultb);
        $bankID  = $k['ID'];
        $fn  = $k['First Name'];
        $ln  = $k['Last Name'];
        $license_no  = $k['License No'];
        $app = $k['App Ref'];
        $obs = $k['OBS'];
    }
}
?>

<title>Add New Pupil</title>
</head>

<body>

    <div class="button_father">
        <a href="index.php">
            <button class="button">Back to Home</button>
        </a>
    </div>

    <h1>Add New Pupil</h1>

    <?php if (!empty($_GET['id'])) { ?>
    <div class="form_father">
        <!-- <label for="bankID" style="padding-bottom:10px;">Copied the Previous Saved Row ID</label> -->
        <input type="hidden" id="lastinsertedrowid" value="<?php echo $_GET['id']; ?>">
        <br>
        <!-- <button id="tigger_click" onclick="myFunction()" class="button">Copied Recent Inserted Row ID</button> -->
    </div>
    <div style="padding-bottom:20px; padding-top:20px;"></div>
    <?php } ?>



    <form method="post" action="new-pupil-results-submit.php">


        <div class="form_father">
            <label for="bankID">Bank ID</label>
            <input type="text" id="bankID" name="bankID" autocomplete="new-password"
                value="<?php echo (isset($bankID)) ? $bankID : ''; ?>" />
        </div>

        <div class="quarter">
            <div class="form_father">
                <label for="title">Title</label>
                <select type="text" id="title" name="title">
                    <option></option>
                    <option>Mr</option>
                    <option>Mrs</option>
                    <option>Miss</option>
                </select>
            </div>

            <div class="form_father">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" autocomplete="new-password"
                    value="<?php echo (isset($fn)) ? $fn : ''; ?>" />
            </div>

            <div class="form_father">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" autocomplete="new-password"
                    value="<?php echo (isset($ln)) ? $ln : ''; ?>" />
            </div>

            <div class="form_father">
                <label for="fee">FEE</label>
                <input type="text" id="fee" name="fee" placeholder="NNNN.NN Or NNNN" pattern="^\d*(\.\d{0,2})?$">
            </div>

            <div class="form_father">
                <label for="date_of_birth">Date of Birth</label>
                <input type="text" id="date_of_birth" name="date_of_birth" placeholder="dd.mm.YYYY"
                    autocomplete="new-password">
            </div>

            <div class="form_father">
                <label for="code">Code</label>
                <input type="text" id="code" name="code">
            </div>

            <div class="form_father">
                <label for="device">Device</label>
                <input type="text" id="device" name="device">
            </div>
        </div>


        <div class="quarter">
            <div class="form_father">
                <label for="applied_on">Applied On</label>
                <input type="text" id="applied_on" name="applied_on" value="<?php echo date('d-m-Y'); ?>"
                    placeholder="dd.mm.YYYY" autocomplete="new-password">
            </div>

            <div class="form_father">
                <label for="license_no">License No</label>
                <input type="text" id="license_no" name="license_no"
                    value="<?php echo (isset($license_no)) ? $license_no : ''; ?>" />
            </div>

            <div class="form_father">
                <label for="app_ref">App Ref</label>
                <input type="text" id="app_ref" name="app_ref" value="<?php echo (isset($app)) ? $app : ''; ?>" />
            </div>

            <div class="form_father">
                <label for="eligible_date">Eligible Date</label>
                <input type="text" id="eligible_date" name="eligible_date" placeholder="dd-mm-YYYY"
                    autocomplete="new-password">
            </div>

            <div class="form_father">
                <label for="theory_exp">Theory Exp</label>
                <input type="text" id="theory_exp" name="theory_exp" placeholder="dd-mm-YYYY"
                    autocomplete="new-password">
            </div>

            <div class="form_father">
                <label for="theocert">Theory Cert</label>
                <input type="text" id="theocert" name="theocert" pattern="[0-9]+" autocomplete="new-password">
            </div>

            <div class="form_father">
                <label for="address_line_1">Address Line 1</label>
                <input type="text" id="address_line_1" name="address_line_1">
            </div>
        </div>


        <div class="quarter">
            <div class="form_father">
                <label for="address_town">Address Town</label>
                <input type="text" id="address_town" name="address_town">
            </div>

            <div class="form_father">
                <label for="address_postcode">Address Postcode</label>
                <input type="text" id="address_postcode" name="address_postcode">
            </div>

            <div class="form_father">
                <label for="email_address">Email Address</label>
                <input type="email" id="email_address" name="email_address">
            </div>

            <div class="form_father">
                <label for="telephone">Telephone</label>
                <input type="tel" id="telephone" name="telephone" pattern="[0-9]+">
            </div>

            <div class="form_father">
                <label for="notes">Notes</label>
                <textarea id="notes" name="notes" rows="6" cols="25"></textarea>
            </div>

            <div class="form_father">
                <label for="clients_id">Client's ID</label>
                <input type="text" list="clients" id="clients_id" name="clients_id" autocomplete="off">
                <datalist id="clients">
                    <option value="Abdi 4555 - Red">
                    <option value="Abdiwali">
                    <option value="Abdul BP">
                    <option value="Abdulfataah">
                    <option value="Abu 6981">
                    <option value="Adelaide">
                    <option value="Aftab 2182">
                    <option value="Ahmed 0269">
                    <option value="Ajma">
                    <option value="ALI - BLACK TAXI">
                    <option value="Ali - Blue Car">
                    <option value="Ali - Top Drive">
                    <option value="Ali Driveland">
                    <option value="ALI TEMP NEW ADI">
                    <option value="Alice 4498">
                    <option value="Allen">
                    <option value="Antimo">
                    <option value="ARI">
                    <option value="Arif">
                    <option value="Artan Jakupi">
                    <option value="Arton">
                    <option value="Amdi">
                    <option value="Athena 8595 Hither Green">
                    <option value="Ash">
                    <option value="Ashfaq YSI 7251">
                    <option value="Awes Omar">
                    <option value="Aylin">
                    <option value="Ayse">
                    <option value="Aysegul TALL">
                    <option value="Bakri">
                    <option value="Bayram">
                    <option value="Boyce">
                    <option value="Burhan">
                    <option value="Bushra 7071">
                    <option value="Cabdi">
                    <option value="Can">
                    <option value="Canan">
                    <option value="Carl">
                    <option value="Cemal GSM">
                    <option value="Cemal Top Drive">
                    <option value="CHRIS B">
                    <option value="Cigdem 0562 Elswick">
                    <option value="Cihan NEW">
                    <option value="Colin EAST LONDON">
                    <option value="Curvis">
                    <option value="Dad">
                    <option value="Dahir">
                    <option value="Danutta">
                    <option value="Dayana">
                    <option value="Dele">
                    <option value="Dennis 1440">
                    <option value="DENIZ HANIM">
                    <option value="Denton">
                    <option value="Dervish">
                    <option value="DIAMOND">
                    <option value="DILAY">
                    <option value="Dinni 9626">
                    <option value="Dogan Spark">
                    <option value="Dogu">
                    <option value="DOM">
                    <option value="Duygu">
                    <option value="Ebru">
                    <option value="Ebru 6224">
                    <option value="Ekin 2370">
                    <option value="Elam">
                    <option value="Elif">
                    <option value="Emerald">
                    <option value="Ercan">
                    <option value="Ersan">
                    <option value="Eyabo">
                    <option value="Fardosa">
                    <option value="Fatma BNG">
                    <option value="Fatmir">
                    <option value="Fidao 1663">
                    <option value="FIZA">
                    <option value="Francis">
                    <option value="Frank">
                    <option value="Fuad 5455">
                    <option value="Gokhan GM1">
                    <option value="GUL GG">
                    <option value="Gul Spark">
                    <option value="Gulizar">
                    <option value="Haidar">
                    <option value="HAKIM">
                    <option value="Hasan Kibrisli">
                    <option value="Hasan NEW ADI GOODMAYES">
                    <option value="Hasan Otoman">
                    <option value="Hasan Rojin">
                    <option value="Helen">
                    <option value="HOTI">
                    <option value="Huseyin Expert">
                    <option value="HUSSAIN 6827">
                    <option value="Ilker">
                    <option value="Independent">
                    <option value="Ismail Spark">
                    <option value="Jacqui">
                    <option value="Jatin 9375">
                    <option value="JOE AA 2020">
                    <option value="Joe Mr">
                    <option value="John Irish">
                    <option value="Johnny">
                    <option value="Kabir">
                    <option value="Keith">
                    <option value="Kenan Duman">
                    <option value="Khalid NEW CHINGFORD">
                    <option value="Kitson">
                    <option value="Klios">
                    <option value="KUTUB">
                    <option value="Levent 7793">
                    <option value="Linda">
                    <option value="Lina 2145">
                    <option value="Lorna">
                    <option value="M. Wali">
                    <option value="Marshal Malik">
                    <option value="Mehmet AA">
                    <option value="Mehmet GL">
                    <option value="MOHAMMED ADI ENFIELD">
                    <option value="Mohamed ADI GOODMAYES">
                    <option value="Mohammed FRM FATIMA">
                    <option value="Mohammed Private">
                    <option value="MRI">
                    <option value="Mubasher Goodmayes/Barking">
                    <option value="Mustafa Bolukbasi">
                    <option value="Mustafa Kartal">
                    <option value="Nafisa ILM">
                    <option value="Nana">
                    <option value="Nazia 7954">
                    <option value="Nevzat AKPINAR">
                    <option value="Nevzat YOUNG">
                    <option value="Noah">
                    <option value="Nurcan">
                    <option value="Ola">
                    <option value="Olu - HITHER GREEN/SIDCUP">
                    <option value="OMAR">
                    <option value="Omar 9340 Hither Green">
                    <option value="Omer 5588">
                    <option value="Ozkan">
                    <option value="Ozgul">
                    <option value="Ozgur NEW">
                    <option value="Pinar 013">
                    <option value="Pinar 367">
                    <option value="Pinar Sevim">
                    <option value="Rafael">
                    <option value="RAHIM">
                    <option value="Rahimah ADI">
                    <option value="Raj 0004 Harrow">
                    <option value="Raj 0205">
                    <option value="Raj 0386 Frm Jatin">
                    <option value="Raj 3494 Wanstead">
                    <option value="Raj 9553 Frm Dad">
                    <option value="Reihaneh 2346 Mill Hill">
                    <option value="Ruun">
                    <option value="Ruth FROM OMAR HITHER GREEN">
                    <option value="Salim Abdul 9127">
                    <option value="Salim xpress">
                    <option value="Salman Box">
                    <option value="Salman Ennis">
                    <option value="Samuel - LEARNER GROUP">
                    <option value="Sania">
                    <option value="Sanket">
                    <option value="Sassi 5409">
                    <option value="Sehnaz Duman">
                    <option value="Sehirah 3999">
                    <option value="Senol 1279">
                    <option value="Serkan Bozkurt">
                    <option value="Sevim">
                    <option value="Sham">
                    <option value="Shameen 3333">
                    <option value="Shaz 4451">
                    <option value="Shazia 2848">
                    <option value="Sinan">
                    <option value="SOLO 1">
                    <option value="Songul">
                    <option value="SULAMAN NEW">
                    <option value="Sunny">
                    <option value="Taher">
                    <option value="Tarik">
                    <option value="Tarik 2444 From Sevim">
                    <option value="TED">
                    <option value="Tevfik">
                    <option value="Timur">
                    <option value="Tomasz">
                    <option value="Ufuk Arjin">
                    <option value="UMUT MEMO YIGEN">
                    <option value="USMAN">
                    <option value="Uygar">
                    <option value="Vahdete">
                    <option value="Vedat YOL">
                    <option value="Volkan 0072">
                    <option value="Volkan Young">
                    <option value="Wahid 9279">
                    <option value="William">
                    <option value="Yadigar">
                    <option value="Yaseen Begl">
                    <option value="Yaseen United">
                    <option value="Yousouff">
                    <option value="Zahide">
                    <option value="ZAK">
                    <option value="Zeynep">
                    <option value="ZZ ASH LEARNER GROUP">
                    <option value="ZZ Ashley - SNAPCC">
                    <option value="ZZ Dasharathbhai - SNAPCC">
                    <option value="ZZ Ed - SNAPCC">
                    <option value="ZZ Hanif 0080">
                    <option value="ZZ INSTA - SAJ">
                    <option value="ZZ JOHNNY - SNAPCC">
                    <option value="ZZ MANHER - SNAPCC">
                    <option value="ZZ Maz - SNAPCC">
                    <option value="ZZ MIZAN - SNAPCC">
                    <option value="ZZ Neeraj - SNAPCC">
                    <option value="ZZ Olu - SNAPCC">
                    <option value="ZZ PUJA - SNAPCC">
                    <option value="ZZ SALEEM - SNAPCC">
                    <option value="ZZ Shek R. - SNAPCC">
                    <option value="ZZ Young MOHAMMAD - SNAPCC">
                    <option value="ZZ ZARA - SNAPCC">
                    <option value="ZZZ Sener - INSTA">
                    <option value="ZZZ INSTA">
                    <option value="ZZZ SNAPCC">
                    <option value="ZZZZZ">
                </datalist>

            </div>

        </div>

        <div class="quarter">

            <div class="form_father">
                <label for="temp_booking_date">Temp Booking Date</label>
                <input type="text" id="temp_booking_date" name="temp_booking_date"
                    placeholder="dd-mm-YYYY hh:mm(am/pm)">
            </div>

            <div class="form_father">
                <label for="temp_booking_centre">Temp Booking Centre</label>
                <input type="text" id="temp_booking_centre" name="temp_booking_centre">
            </div>

            <div class="form_father">
                <label for="temp_booking_code">Temp Booking Code</label>
                <input type="text" id="temp_booking_code" name="temp_booking_code">
            </div>

            <div class="form_father">
                <label for="OBS">OBS</label>
                <input type="text" id="OBS" name="OBS" value="<?php echo (isset($obs)) ? $obs : ''; ?>" />
            </div>

            <div class="form_father">
                <label for="booked_for">Booked For</label>
                <input type="text" id="booked_for" name="booked_for" placeholder="dd-mm-YYYY hh:mm(am/pm)">
            </div>

            <div class="form_father">
                <label for="test_centre">Test Centre</label>
                <input type="text" id="test_centre" name="test_centre">
            </div>

            <div class="form_father">
                <label for="booked_on">Booked On</label>
                <input type="text" id="booked_on" name="booked_on" placeholder="dd-mm-YYYY hh:mm:ss">
            </div>

            <div class="form_father">
                <label for="special_code">Special Code</label>
                <input type="text" id="special_code" name="special_code">
            </div>
        </div>
        <div style="clear: both;"></div>

        <br>

        <div class="form_father">
            <button id="submit" name="submit" class="button">Add New Pupil</button>
        </div>

    </form>






    <script src="src/jquery.min.js"></script>

    <script>

    //tigger click functioin on button click
    $(document).ready(function() {

        var copyText = document.getElementById("lastinsertedrowid");
        if (copyText.value != "") {


            /* Select the text field */
            copyText.select();
            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);
            /* Alert the copied text */
            alert("Copied the ID: " + copyText.value);
        }
    });
    </script>
    <?php


    include('footer.php');

    ?>