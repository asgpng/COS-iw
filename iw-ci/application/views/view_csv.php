<table cellpadding="0" cellspacing="0" width="100%">
<tr>
  <td width = "10%">netID</td>
  <td width = "20%">user_type</td>
</tr>

<?php foreach($csvData as $field){?>
<tr>
  <td><?php echo $field['netID']?></td>
  <td><?php echo $field['user_type']?></td>
</tr>
<?php }?>
</table>
