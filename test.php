
<!DOCTYPE html>
<html>
<head>
    <title>example title</title>
</head>

<body>
    <p>Click on the button to copy the text from the text field. Try to paste the text </p>

    <input type="text" id="myInput">
    <button onclick="myFunction()">Copy textXXXX</button>

    <script>
    function myFunction() {
        let inputEl = document.getElementById("myInput");
        inputEl.select();                                    // Select element
        inputEl.setSelectionRange(0, inputEl.value.length); // select from 0 to element length

        const successful = document.execCommand('copy');   // copy input value, and store success if needed

        if(successful) {
            alert("Copied the text: " + inputEl.value);
        } else {
            // ...
        }
    }
    </script>
</body>
</html>