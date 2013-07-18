<h2>View Student Forms: February</h2>
<div>
  <table border="1">
    <tr>
      <th>Student NetID</th>
      <th>Advisor NetID</th>
      <th>Semester</th>
      <th>Number of Meetings</th>
      <th>Student Comments</th>
      <th>Advisor Read</th>
      <th>Advisor More Meetings</th>
      <th>Student Progress Eval</th>
      <th>Advisor Comments</th>
    </tr>
    <?php foreach ($query->result() as $row): ?>
    <tr>
      <td><?php echo $row->student_netID; ?></td>
      <td><?php echo $row->advisor_netID; ?></td>
      <td><?php echo $row->semester; ?></td>
      <td><?php echo $row->number_of_meetings; ?></td>
      <td><?php echo $row->student_comments; ?></td>
      <td><?php echo $row->advisor_read; ?></td>
      <td><?php echo $row->advisor_more_meetings; ?></td>
      <td><?php echo $row->student_progress_eval; ?></td>
      <td><?php echo $row->advisor_comments; ?></td>
    </tr>
   <?php endforeach; ?>
  </table>

<hr>

  <a href="/iw-ci/index.php/admin/download?name=export_f.csv&data=february" >Export</a>

</div>
