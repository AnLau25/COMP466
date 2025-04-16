<?php if ($_SERVER['REQUEST_METHOD']=='POST'){
	$M = $_POST['M']??null;//otherwise null 
	$N = $_POST['N']??null;	
	
	$GCD = 0;

	$M_div = [];
	$N_div = [];

	$M_count = 0;
	$N_count = 0;

	for($i=1; $i<=$M; $i++){
		if($M%$i==0){
			$M_div[$M_count]=$i;
			$M_count++;
		}
	}

	for($i=1; $i<=$N; $i++){
		if($N%$i==0){
			$N_div[$N_count]=$i;
			$N_count++;
		}
	}

	
	for($i=0; $i<$M_count; $i++){
		for($j=0; $j<$N_count; $j++){
			if($M_div[$i]==$N_div[$j]){
				$GCD = $M_div[$i]; 
			}
		}
	}

	echo "<table>";
	echo "<tr><td>GCD: </td><td>".$GCD."</td></tr>";
	echo "<tr><td>Divisors of ".$M."</td><td>";
	for ($i=0; $i<$M_count; $i++){
		echo $M_div[$i]." ";
	}
	echo"</tr>";
	echo "<tr><td>Divisors of ".$N."</td><td>";
	for ($i=0; $i<$N_count; $i++){
		echo $N_div[$i]." ";
	}
	echo"</tr>";
	echo "</table>";
}

php>

<html>
<head>
	<title>Find GCD</title>
</head>

<body>
	
	<h1>Enter your two nubers</h1>
	<form id="form" method="post">
		<p>
		<label>Enter number M: 
			<input type="textbox" id="m" placeholder="First number">
			<input type="hidden" name="M" id="m_hidden">
		</label>
		</p>

		<p>
		<label>Enter number N: 
			<input type="textbox" id="n" placeholder="First number">
			<input type="hidden" name="N" id="n_hidden">
		</label>
		</p>
		
		<button type="submit">Submit</button>
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
					window.alert('Both numbers must be entered');
				}else if (!Number.isInteger(M) || !Number.isInteger(N)){
					window.alert('Both numbers must be integers')
				}else if (M==0 || N==0){
					window.alert('Neither number should be 0')
				}else{
					document.getElementById('m_hidden').value = M;
					document.getElementById('n_hidden').value = N;
					
					document.getElementById('form').submit();
				}

			}catch(e){
				window.alert('Please enter valid numbers');
			}
		}
	</script>
</body>
</html>