<?php
// Database connection
require_once '../connection/conf.php';
require_once '../function/fun.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'add') {
        $task_name = $conn->real_escape_string($_POST['task_name']);
        $conn->query("INSERT INTO tasks (task_name) VALUES ('$task_name')");
    } elseif ($action == 'delete') {
        $id = intval($_POST['id']);
        $conn->query("DELETE FROM tasks WHERE id = $id");
    } elseif ($action == 'toggle') {
        $id = intval($_POST['id']);
        $is_completed = intval($_POST['is_completed']);
        $conn->query("UPDATE tasks SET is_completed = $is_completed WHERE id = $id");
    }

    exit;
}

// Fetch tasks from the database
$result = $conn->query("SELECT * FROM tasks");
$tasks = $result->fetch_all(MYSQLI_ASSOC);
?>
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

    <link rel="stylesheet" href="../Dashboard/Sider.css" />

    <!-- get bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <style>
        .completed {
            text-decoration: line-through;
            color: red;
        }
    </style>
    <link rel="stylesheet" href="../Style/TodoList.css" />
    <link rel="stylesheet" href="../Style/Home.css" />
  </head>
  <body>
    <div class="main p-3">
        <div class="container2">
            <!-- To-Do list start -->
            <div class="todo-list col-12 col-md-8 col-lg-6 mx-auto">
                <h2 class="text-center mb-4">To-Do List</h2>
                <div class="row mb-3">
                    <div class="col-12 col-sm-8 mb-2 mb-sm-0">
                        <input type="text" class="add-task form-control" id="task_name" placeholder="Enter a new task">
                    </div>
                    <div class="col-12 col-sm-4">
                        <button id="add_button" class="btn btn-primary w-100">Add</button>
                    </div>
                </div>
                <ul id="task_list" class="task_list list-group align-items-center ">
                    <?php foreach ($tasks as $task): ?>
                        <li data-id="<?= $task['id'] ?>" class="list-group-item d-flex align-items-center <?= $task['is_completed'] ? 'completed' : '' ?>">
                            <input type="checkbox" class="task_checkbox form-check-input me-2" <?= $task['is_completed'] ? 'checked' : '' ?>>
                            <div class="task_text flex-grow-1"><?= htmlspecialchars($task['task_name']) ?></div>
                            <button class="delete_button btn btn-danger btn-sm">X</button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#add_button').on('click', function() {
            const task_name = $('#task_name').val().trim();
            if (task_name) {
                $.post('', { action: 'add', task_name: task_name }, function() {
                    location.reload();
                });
            }
        });

        $('.delete_button').on('click', function() {
            const id = $(this).closest('li').data('id');
            $.post('', { action: 'delete', id: id }, function() {
                location.reload();
            });
        });

        $('.task_checkbox').on('change', function() {
            const li = $(this).closest('li');
            const id = li.data('id');
            const is_completed = this.checked ? 1 : 0;
            $.post('', { action: 'toggle', id: id, is_completed: is_completed }, function() {
                li.toggleClass('completed');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 
<?php
$conn->close();
?>

