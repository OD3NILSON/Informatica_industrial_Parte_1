 <!DOCTYPE html>
<html>
<head>	 
<p align="center">	
<img src="https://pbs.twimg.com/profile_images/1081149776404590592/REI4-FCq_400x400.jpg"
width="200" height="130">
</p>
<p class = "dados" align="center" width="200" border="0" cellspacing="100" cellpadding="0"  >
     
	 
	 UNIDADE ACADEMICA DE ENGENHARIA ELETRICA <br/>
	 CENTRO DE ENGENHARIA ELETRICA E INFORMATICA (CEEI)<br/>
	 UNIVERSIDADE FEDERAL DE CAMPINA GRANDE (UFCG) <br/>
	 <br/>
	 DISCIPLINA: INFORMATICA INDUSTRIAL <br/>
     PROFESSOR: DANILO <br/>
	   <br/>
	   <br/>
	   <br/>
     SISTEMA DE MONITORAMENTO DE NIVEL D'AGUA<br/>   
	 <br/>
</p>

<head>
<meta http-equiv='refresh' content='3'>
</head>

	 


	  <?php  
	include "conexao.php";
	
	$HOST =  "localhost";
			$BANCO = "bdnodemcu";
			$USUARIO = "root";
			$SENHA = "";
	$PDO = new PDO("mysql:host=" . $HOST . ";dbname=" . $BANCO . ";charset=utf8", $USUARIO, $SENHA);
	
		$sql = 'SELECT sensor1, sensor2, sensor3  FROM  tbdados ';
	
		$stmt = $PDO->prepare($sql);
		$stmt->execute();

		 $stmt->bindColumn(1, $sensor1);
		 $stmt->bindColumn(2, $sensor2);
		 $stmt->bindColumn(3, $sensor3);
		
		$A=0;
		$B=0;
		$C=0;
		while($dado = $stmt->fetch(PDO:: FETCH_BOUND)){

           $A =$sensor1;
		   $B= $sensor2;
		   $C= $sensor3;
		 }
		
	 	
	?>

		 <table align="center" width="400"  border="1" cellspacing="0" cellpadding="10" style="border-left:solid; border-right:solid;
	 border-top:solid;border-bottom:solid; border-width:1px; border-color:#009;">
	

	 <tbody>
	   
	  
	 
	 <tr> 
	 <?php
        if($A == 1){?> 
		<td height="50" bgcolor="blue" ><center><font face="Verdana" size="3" color="#FFFFF">Nivel Maximo</font></center></td> 
		<?php
		}
		else
		{?> 
		<td height="50" ><center><font face="Verdana" size="3" >Nivel Maximo</font></center></td> 
		<?php
		}
		?>
		</tr>
		<tr> <?php
		if($B == 1){
		?> <td height="50" bgcolor="blue" ><center><font face="verdana" size="3" color="#FFFFFF">Nivel Medio</font></center></td> <?php
		}
		else
		{
		?> <td height="50" ><center><font face="verdana" size="3" >Nivel Medio</font></center></td><?php
		}
		?> </tr>
		<tr> <?php

		if($C == 1){
		?> <td height="50" bgcolor="blue" ><center><font face="Verdana" size="3" color="#FFFFFF">Nivel Baixo</font></center></td> <?php
		}
		else
		{
		?> <td height="50" ><center><font face="Verdana" size="3" >Nivel Baixo</font></center></td> <?php
		}
		?> </tr>
		</tbody>
		
	  </table>
	  <?php
		 
		 
?>
</head>		
</html>
	  
