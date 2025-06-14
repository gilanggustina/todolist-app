<?php

function displayTasks($tasks)
{
    foreach ($tasks as $i => $task) {
        $checked = $task["done"] ? "checked" : "";
        $class = $task["done"] ? "line-through text-gray-400" : "text-gray-800";
        $deadlineText = isset($task["deadline"]) && $task["deadline"]
            ? '<div class="text-xs text-gray-500">' . date("d M Y H:i", strtotime($task["deadline"])) . '</div>'
            : "";
        $highlight = (isset($task["deadline"]) && strtotime($task["deadline"]) - time() <= 3600 && !$task["done"]) ? "bg-yellow-100" : "";

        echo "
        <li class=\"task-item $highlight flex items-start justify-between px-4 py-2 border-b bg-white\" data-index=\"$i\">
            <form method='POST' class='flex items-start gap-2 w-full'>
                <input type='hidden' name='toggle_done' value='$i'>
                <input type='checkbox' class='mt-1 accent-green-600' onchange='this.form.submit()' $checked>
                <div class='flex-grow'>
                    <div class=\"{$class}\">" . htmlspecialchars($task['title']) . "</div>
                    $deadlineText
                </div>
            </form>
            <div class='flex gap-2'>
                <button type='button' onclick='editTask($i)' class='bg-[#f27c41] text-white px-4 py-2 rounded hover:opacity-80'>Edit</button>
                <button type='button' onclick='openConfirmModal($i)' class='bg-[#DC2626] text-white px-4 py-2 rounded hover:opacity-80'>Delete</button>
            </div>
        </li>";
    }
}
