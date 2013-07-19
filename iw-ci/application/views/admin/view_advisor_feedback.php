<h2>View Advisor Feedback</h2>
<div>
  <table border="1">
    <tr>
      <th>Student NetID</th>
      <th>Advisor NetID</th>
      <th>Semester</th>
      <th>Research</th>
      <th>Research Progress</th>
      <th>Paper</th>
      <th>Initiative</th>
      <th>Plans</th>
      <th>Percentile</th>
      <th>Suggested Grade</th>
      <th>Comments</th>
    </tr>
    <?php foreach ($query->result() as $row): ?>
    <tr>
      <td><?php echo $row->student_netID; ?></td>
      <td><?php echo $row->advisor_netID; ?></td>
      <td><?php echo $row->semester; ?></td>
      <td><?php echo $row->research; ?></td>
      <td><?php echo $row->research_progress; ?></td>
      <td><?php echo $row->paper; ?></td>
      <td><?php echo $row->initiative; ?></td>
      <td><?php echo $row->plans; ?></td>
      <td><?php echo $row->percentile; ?></td>
      <td><?php echo $row->suggested_grade; ?></td>
      <td><?php echo $row->comments; ?></td>
    </tr>
   <?php endforeach; ?>
  </table>

<hr>
  <?php echo anchor('admin/download?name=export_af.csv&data=advisor_feedback', 'Export'); ?>

</div>
