	<a href="<?=base_url()?><?=$module?>add">Add Data</a>
    <table border="1">
    <thead>
    	<tr><th>Nama</th><th>Kelas</th><th>Action</th></tr>
     </thead>
     <tbody>
<?
	
    foreach($arrDB as $x=>$val):
		?>
		<tr>
        	<td><?=$val["nama"]?></td>
            <td><?=$val["kelas"]?></td>
            <td><a href="<?=base_url()?><?=$module?>edit/<?=$val["idx"]?>">Edit</a>&nbsp;|&nbsp;<a href="<?=base_url()?><?=$module?>delete/<?=$val["idx"]?>">Delete</a></td>
        </tr>
        <?
	endforeach;
?>
	</tbody>
	</table>