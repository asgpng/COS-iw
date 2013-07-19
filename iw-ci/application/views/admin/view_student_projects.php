<h2>View Student Projects</h2>
<div>
  <table border="1">
    <tr>
      <th>Student NetID</th>
      <th>Advisor NetID</th>
      <th>Second Reader NetID</th>
      <th>Semester</th>
      <th>Project Title</th>
      <th>Description</th>
      <th>Coursework</th>
      <th>Date Began</th>
      <th>Date Met</th>
      <th>Advisor Approved</th>
      <th>Second Reader Approved</th>
    </tr>
    <?php foreach ($project->result() as $row): ?>
    <tr>
      <td><?php echo $row->student_netID; ?></td>
      <td><?php echo $row->advisor_netID; ?></td>
      <td><?php echo $row->second_reader_netID; ?></td>
      <td><?php echo $row->semester; ?></td>
      <td><?php echo $row->project_title; ?></td>
      <td><?php echo $row->description; ?></td>
      <td><?php echo $row->coursework; ?></td>
      <td><?php echo $row->date_began; ?></td>
      <td><?php echo $row->date_met; ?></td>
      <?php if ($row->advisor_approved == "1"):  ?>
      <td>Yes</td>
      <?php else: ?>
      <td>No</td>
      <?php endif; ?>
      <?php if ($row->second_reader_approved == "1"):  ?>
      <td>Yes</td>
      <?php else: ?>
      <td>No</td>
      <?php endif; ?>

    </tr>
   <?php endforeach; ?>
  </table>

<hr>
  <?php echo anchor('admin/download?name=export_p.csv&data=project', 'Export'); ?>
</div>
