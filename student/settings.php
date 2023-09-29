<!DOCTYPE html>
<html>
<head>
	<title>List of Tutors</title>
	<style>
		.tutors-table {
			width: 100%;
			border-collapse: collapse;
		}
		.tutors-table td, .tutors-table th {
			padding: 8px;
			border: 1px solid #ddd;
		}
		.tutors-table th {
			background-color: #f2f2f2;
		}
	</style>
</head>
<body>

	<h1>List of Tutors</h1>

	<?php
		// Array of tutors
		$tutors = array(
			array("John Smith", "Mathematics"),
			array("Jane Doe", "English"),
			array("Bob Johnson", "History")
		);
	?>

	<table class="tutors-table">
		<tr>
			<th>Name</th>
			<th>Subject</th>
		</tr>
		<?php
			// Loop through tutors and output them in a table row
			foreach ($tutors as $tutor) {
				echo "<tr>";
				echo "<td>" . $tutor[0] . "</td>";
				echo "<td>" . $tutor[1] . "</td>";
				echo "</tr>";
			}
		?>
	</table>

</body>
</html>