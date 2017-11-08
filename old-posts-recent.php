<meta name="robots" content="noindex">
<?php
/**
* Template Name: Old Posts Recent
*/
$posts = query_posts(array('showposts' => 500, 'orderby' => 'date', 'order' => 'desc'));
echo "<table border='1'>";
echo "<tr>
<td>ID</td>
<td>Title</td>
<td>Author</td>
<td>Date</td>
<td>Tags</td>
<td>Content</td>
</tr>";
while(have_posts()) : the_post();
		echo "<tr>";
		echo "<td>".get_the_id()."</td>";
		echo "<td>".get_the_title()."</td>";
		echo "<td>".get_the_author()."</td>";
		echo "<td>".get_the_date()."</td>";
		echo "<td>";
		$posttags = get_the_tags();
		if ($posttags) {
		  foreach($posttags as $tag) {
		    echo $tag->name . ';'; 
		  }
		}
		echo "</td>";
		echo "<td>".wp_strip_all_tags(get_the_content())."</td>";
		echo "</tr>";
endwhile;
echo "</table>";
?>
