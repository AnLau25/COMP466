<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $M = $_POST['M']??null;
    $N = $_POST['N']??null;

    $GCD=0;
    $M_Divs=[];
    $N_Divs=[];

    $count1=0;
    for($i=1; $i<=$M; $i++){
        if(($M % $i) == 0){
            $M_Divs[$count1]=$i;
            $count1++;
        }
    }

    $count2=0;
    for($i=1; $i<=$N; $i++){
        if(($N % $i) == 0){
            $N_Divs[$count2]=$i;
            $count2++;
        }
    }

    for($i=0; $i<$count1; $i++){
        for($j=0; $j<$count2; $j++){
            if($M_Divs[$i]==$N_Divs[$j]){
                $GCD=$M_Divs[$i];
            }
        }
    }

    echo "<table>";
    echo "<tr>
            <td>GCD:</td>
            <td>$GCD</td>
        </tr>";
    echo "<tr><td>Divisors of $M:</td>";
    for ($i=0; $i<$count1; $i++){
        echo "<td>" .$M_Divs[$i]. "</td>";
    }
    echo"</tr>";
    
    echo "<tr><td>Divisors of $N:</td>";
    for ($i=0; $i<$count2; $i++){
        echo "<td>" .$N_Divs[$i]. "</td>";
    }
    echo"</tr>";
    echo "</table>";
    
}



?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8"/>
        <title>Test q1</title>
        <style>
            td{
                border: 1px solid black;
            }
            table{
                boder-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <h1>Dummy page</h1>
        <img src="DummyMax.jpg"/>
        <form method="post" id="form">
            <p>
                <label>Number 1 (M):
                    <input id="m" type="text" placeholder="Integer > 0">
                    <input type="hidden" name="M" id="M_hidden">
                </label>
            </p>
            <p>
                <label>Number 2 (N):
                    <input  id="n" type="text" placeholder="Integer > 0">
                    <input type="hidden" name="N" id="N_hidden">
                </label>
            </p>
            <p>
                <button type="submit">Submit</button>
            </p>
        </form>

        <script>
            document.getElementById('form').addEventListener('submit', handleSubmit);

            function handleSubmit(event){
                event.preventDefault();
                var M, N;

                try{
                    M = Number(document.getElementById('m').value);
                    N = Number(document.getElementById('n').value);
                    
                    if(!M || !N){
                        window.alert("Both numbers must be there.");
                    }else if(M<=0 || N<=0){
                        window.alert("Both numbers must be positive.");
                    }else if(!Number.isInteger(M) || !Number.isInteger(N)){
                        window.alert("Both numbers must be integers.")
                    }else{
                        document.getElementById('M_hidden').value=M;
                        document.getElementById('N_hidden').value=N;

                        document.getElementById('form').submit();
                    }
                }catch (e){
                    window.alert("Please enter valid numbers.");
                }
            }
           
            
        </script>

    </body>
</html>