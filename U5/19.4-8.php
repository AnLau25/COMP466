<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finding patterns</title>
</head>
    <?php
        $ptrn = "/^A[a-zA-Z0-9]{3}[Bb]+\\d{2}$/";
        //^ must be at start 
        //A means that it has to be that A
        //[a-zA-Z0-9]{3} alphanum and count 3; could've ussed \w, but that one includes _
        //[Bb]+ one or more occurences
        // \\d{2} 2 digits, \\ cause more than one, so \d for one and \\d+
        // Assert the string
        $strA = "Alo5b14"; 
        $strB = "Vet5b14";
        $strC = "Alo+nonalpha";
        $strD = "Alo5Cnotb";
        $strE = "Alo5bnonums";
    ?>
<body>
    <?php
        function stringCompare($p, $s){
            if(preg_match($p, $s)){
                echo "Eso tilin! <br>";
            }else{
                echo "No Mussolini no... <br>";
            };
        };

        stringCompare($ptrn, $strA);
        stringCompare($ptrn, $strB);
        stringCompare($ptrn, $strC);
        stringCompare($ptrn, $strD);
        stringCompare($ptrn, $strE);

    ?>  
</body>
</html>