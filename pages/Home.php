<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <!-- get icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <lord-icon trigger="hover" src="/my-icon.json"></lord-icon>

    <link rel="stylesheet" href="../Sidebar/Sider.css" />

    <!-- get bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="../Style/Home.css" />
  </head>
  <body>
<<<<<<< Updated upstream
    
          <!-- <div class="title text-center">
            <h3>-Today Time Table-</h3>
          </div> -->

          <!-- timetable -->
          <!-- <section class="p-5">
            <div class="table-responsive" id="table1">
              <table class="table bg-white">
                <thead class="bg-dark text-light">
                  <tr>
                    <th>Time</th>
                    <th>Year</th>
                    <th>Subject</th>
                    <th>Venue</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td data-title="Time">2019/ASP/01</td>
                    <td data-title="Year">2nd Year</td>
                    <td data-title="Subject">Subject 01</td>
                    <td data-title="Venue">SL</td>
                  </tr>
                  <tr>
                    <td data-title="Time">2019/ASP/01</td>
                    <td data-title="Year">2nd Year</td>
                    <td data-title="Subject">Subject 01</td>
                    <td data-title="Venue">LH1</td>
                  </tr>
                  <tr>
                    <td data-title="Time">2019/ASP/01</td>
                    <td data-title="Year">2nd Year</td>
                    <td data-title="Subject">Subject 01</td>
                    <td data-title="Venue">LH2</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section> -->
       

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="../Sidebar/Main.js"></script>
  </body>
</html>
=======
    <div class="main p-3">
        <div class="container2">
            <!-- To-Do list start -->
            <div class="todo-list">
                <h2>To-Do List</h2>
                <div class="row">
                    <input type="text" class="add-task" id="task_name" placeholder="Enter a new task">
                    <button id="add_button">Add</button>
                </div>
                    <ul id="task_list" class="task_list">
                        <?php foreach ($tasks as $task): ?>
                            <li data-id="<?= $task['id'] ?>" class="<?= $task['is_completed'] ? 'completed' : '' ?>">
                                <div class="task-content">
                                <input type="checkbox" class="task_checkbox" <?= $task['is_completed'] ? 'checked' : '' ?>>
                                <?= htmlspecialchars($task['task_name']) ?>
                                </div>
                                <button class="delete_button">X</button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#add_button').on('click', function() {
            const task_name = $('#task_name').val().trim();
            if (task_name) {
                $.post('../pages/Home.php', { action: 'add', task_name: task_name }, function() {
                    location.reload();
                });
            }
        });

        $('.delete_button').on('click', function() {
            const id = $(this).closest('li').data('id');
            $.post('../pages/Home.php', { action: 'delete', id: id }, function() {
                location.reload();
            });
        });

        $('.task_checkbox').on('change', function() {
            const li = $(this).closest('li');
            const id = li.data('id');
            const is_completed = this.checked ? 1 : 0;
            $.post('../pages/Home.php', { action: 'toggle', id: id, is_completed: is_completed }, function() {
                li.toggleClass('completed');
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
>>>>>>> Stashed changes
