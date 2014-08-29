<?php
session_start();
?>

<?php require "inc/header.php";?>
<section class="intro">
        <div class="intro-body">
        	<div class="row">
            	<div class="col-md-4 col-md-offset-4">
                    <div class="choose-section">
	

<?php
include 'connect.php';
$cpucooler = $_POST['optionsRadios'];
$price = $_POST['slider3'];
$pcuse = $_POST['optionsCheck'];
$video = isset($_POST['video']);
$gaming = isset($_POST['gaming']);

// Table header
echo "<table class='table'><tr><th>Part</th><th>Part Name</th><th>Price</th><th>Info</th><th>Message</th></tr>";

// Determine what spec the PC is
if($price>750){
	$priceOutput = "High";
}
else if($price<750 && $price>550){
	$priceOutput = "Mid";
}
else{
	$priceOutput = "Low";
}

// Will the user be overclocking?
if($cpucooler == 'option1'){
	$cpucoolerOutput = mysql_query("SELECT * FROM part WHERE partID = '5'");
}
else{
	$cpucoolerOutput = mysql_query("SELECT * FROM part WHERE partID = '17'");
}

// Video build
if($video =='video'){
	$videoOutput = "Video";
}
else{
	$videoOutput = "";
}
// Gaming build
if($gaming == 'gaming'){
	$gamingOutput = "Gaming";
}
else{
	$gamingOutput = "";
}

$finalOutput = ($priceOutput. " " . $videoOutput. "" . $gamingOutput. " ");

echo "</br>You have selected a $priceOutput end build with a budget of £$price";

// Queries
$cpuOutput = mysql_query("SELECT * FROM partUses, uses, part WHERE part.partID=partUses.PartID AND uses.usesID=partUses.usesID AND part.item ='CPU' AND uses.text = '$finalOutput'");
$cpurow = mysql_fetch_array($cpuOutput);

$motherboardOutput = mysql_query("SELECT * FROM partUses, uses, part WHERE part.partID=partUses.PartID AND uses.usesID=partUses.usesID AND uses.text = '$finalOutput' AND part.item ='Motherboard'");
$motherboardrow = mysql_fetch_array($motherboardOutput);

$memoryOutput = mysql_query("SELECT * FROM partUses, uses, part WHERE part.partID=partUses.PartID AND uses.usesID=partUses.usesID AND uses.text = '$finalOutput' AND part.item ='Memory'");
$memoryrow = mysql_fetch_array($memoryOutput);

$storageOutput = mysql_query("SELECT * FROM partUses, uses, part WHERE part.partID=partUses.PartID AND uses.usesID=partUses.usesID AND uses.text = '$finalOutput' AND part.item ='Storage'");
$storagerow = mysql_fetch_array($storageOutput);

$powersupplyOutput = mysql_query("SELECT * FROM partUses, uses, part WHERE part.partID=partUses.PartID AND uses.usesID=partUses.usesID AND uses.text = '$finalOutput' AND part.item ='PSU'");
$powersupplyrow = mysql_fetch_array($powersupplyOutput);

$videocardOutput = mysql_query("SELECT * FROM partUses, uses, part WHERE part.partID=partUses.PartID AND uses.usesID=partUses.usesID AND uses.text = '$finalOutput' AND part.item ='GPU'");
$videocardrow = mysql_fetch_array($videocardOutput);

$cpucoolerrow = mysql_fetch_array($cpucoolerOutput);
$caseOutput = mysql_query("SELECT * FROM part WHERE partID = '1'");
$caserow = mysql_fetch_array($caseOutput);

// Table output
	echo "<tr>";
	echo "<td>CPU</td>";
	echo "<td><a href='" . $cpurow['url']. "' target='_blank'>" . $cpurow['name']. "</a></td>";
	echo "<td class='price'>" . $cpurow['price']. "</td>";
	echo "<td>" . $cpurow['info']. "</td>";
	echo "<td>" . $cpurow['message']. "</td></tr>";

	echo "<tr>";
	echo "<td>CPU Cooler</td>";
	echo "<td><a href='" . $cpucoolerrow['url']. "' target='_blank'>" . $cpucoolerrow['name']. "</a></td>";
	echo "<td class='price'>" . $cpucoolerrow['price']. "</td>";
	echo "<td>" . $cpucoolerrow['info']. "</td>";
	echo "<td>" . $cpucoolerrow['message']. "</td>";

	echo "<tr>";
	echo "<td>Motherboard</td>";
	echo "<td><a href='" . $motherboardrow['url']. "' target='_blank'>" . $motherboardrow['name']. "</a></td>";
	echo "<td class='price'>" . $motherboardrow['price']. "</td>";
	echo "<td>" . $motherboardrow['info']. "</td>";
	echo "<td>" . $motherboardrow['message']. "</td></tr>";

	echo "<tr>";
	echo "<td>Memory</td>";
	echo "<td><a href='" . $memoryrow['url']. "' target='_blank'>" . $memoryrow['name']. "</a></td>";
	echo "<td class='price'>" . $memoryrow['price']. "</td>";
	echo "<td>" . $memoryrow['info']. "</td>";
	echo "<td>" . $memoryrow['message']. "</td>";

	echo "<tr>";
	echo "<td>Storage</td>";
	echo "<td><a href='" . $storagerow['url']. "' target='_blank'>" . $storagerow['name']. "</a></td>";
	echo "<td class='price'>" . $storagerow['price']. "</td>";
	echo "<td>" . $storagerow['info']. "</td>";
	echo "<td>" . $storagerow['message']. "</td>";

	echo "<tr>";
	echo "<td>Video Card</td>";
	echo "<td><a href='" . $videocardrow['url']. "' target='_blank'>" . $videocardrow['name']. "</a></td>";
	echo "<td class='price'>" . $videocardrow['price']. "</td>";
	echo "<td>" . $videocardrow['info']. "</td>";
	echo "<td>" . $videocardrow['message']. "</td>";

	echo "<tr>";
	echo "<td>Power Supply</td>";
	echo "<td><a href='" . $powersupplyrow['url']. "' target='_blank'>" . $powersupplyrow['name']. "</a></td>";
	echo "<td class='price'>" . $powersupplyrow['price']. "</td>";
	echo "<td>" . $powersupplyrow['info']. "</td>";
	echo "<td>" . $powersupplyrow['message']. "</td>";

	echo "<tr>";
	echo "<td>Case</td>";
	echo "<td><a href='" . $caserow['url']. "' target='_blank'>" . $caserow['name']. "</a></td>";
	echo "<td class='price'>" . $caserow['price']. "</td>";
	echo "<td>" . $caserow['info']. "</td>";
	echo "<td>" . $caserow['message']. "</td>";

	echo "<tr>";
	echo "<td></td>";
	echo "<td>Total:</td>";
	echo "<td id='result'></td>";
	echo "<td></td>";
	echo "<td></td>";
	
	echo "</tr>";
	echo "</table>";

?>	

    			</div>
    		</div>
		</div>
	</div>
</section>
<script>
// Function to calculate build price
$(calculateSum);  
 function calculateSum() {
var sum = 0;
// Iterate through each td based on class and add the values
$(".price").each(function() {

    var value = $(this).text();
    // add only if the value is number
    if(!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
    }
});
$('#result').text(sum);    
};
</script>  
</body>
	
</html>