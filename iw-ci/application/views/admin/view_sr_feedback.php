<h2>View Second Reader Feedback</h2>
<div>
  <table border="1">
    <tr>
      <th>Student NetID</th>
      <th>Advisor NetID</th>
      <th>Semester</th>
      <th>Research</th>
      <th>Research Progress</th>
      <th>Paper</th>
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
      <td><?php echo $row->comments; ?></td>
    </tr>
   <?php endforeach; ?>
  </table>

<hr>

  <a href="/iw-ci/index.php/admin/download?name=export_srf.csv&data=second_reader_feedback" >Export</a>

</div>
