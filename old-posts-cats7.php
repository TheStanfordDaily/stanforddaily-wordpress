<?php
/**
* Template Name: Old Posts w/Categories 7
*/
$posts = query_posts(array('showposts' => -1, 'orderby' => 'date', 'order' => 'desc'));
$i = 0;
echo "<table border='1'>";
echo "<tr>
<td>ID</td>
<td>Title</td>
<td>Author</td>
<td>Date</td>
<td>Tags</td>
<td>Categories</td>
<td>Content</td>
</tr>";
while(have_posts()) : the_post();
	$i++;
	if ($i >= 6000 && $i < 8000):
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
		echo "<td>".get_the_category_list(';')."</td>";
		echo "<td>".wp_strip_all_tags(get_the_content())."</td>";
		echo "</tr>";
	endif;
endwhile;
echo "</table>";
?>
