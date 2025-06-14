<?php global $feedback;
require_once 'tasks.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen text-gray-900 flex items-center justify-center">
  <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
      <div class="flex justify-between items-center mb-4">
          <h1 class="text-2xl font-bold">Todo List App</h1>
      </div>
      <?php if ($feedback): ?>
          <div class="mb-4 p-3 rounded-md bg-blue-100 text-blue-700 text-sm">
              <?= $feedback ?>
          </div>
      <?php endif; ?>
      <form method="POST" class="mb-6 grid grid-cols-2 gap-2" id="taskForm">
          <input type="hidden" name="index" id="taskIndex">
          <input type="text" name="task" id="taskInput" class="border rounded px-4 py-2 text-black" placeholder="Title">
          <input type="datetime-local" name="deadline" id="taskDeadline" class="border rounded px-4 py-2 text-black">
          <div class="w-full flex col-span-2">
            <button type="submit" class="bg-[#4197f2] text-white px-4 py-2 rounded hover:opacity-80 w-full">Simpan</button>
          </div>
      </form>
      <ul id="taskList" class="list-group" data-id="sortable-tasks">
          <?php if (!empty($tasks)): ?>
              <?php displayTasks($tasks); ?>
          <?php else: ?>
              <li class="list-group-item text-muted text-center">Belum ada tugas.</li>
          <?php endif; ?>
      </ul>
  </div>
  <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h2>
      <p class="text-sm text-gray-600 mb-6">Apakah kamu yakin ingin menghapus tugas ini?</p>
      <form method="POST" id="confirmDeleteForm" class="flex justify-end gap-3">
        <input type="hidden" name="delete" id="deleteIndexInput">
        <button type="button" onclick="closeConfirmModal()"
          class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
      </form>
    </div>
  </div>
  <script>
      const el = document.getElementById('taskList');

      new Sortable(el, {
          animation: 150,
          onEnd: function () {
              const newOrder = [...el.querySelectorAll("li")].map(item => item.dataset.index);
              fetch('reorder.php', {
                  method: 'POST',
                  headers: {'Content-Type': 'application/json'},
                  body: JSON.stringify({order: newOrder})
              }).then(r => r.ok && console.log("Order updated"));
          }
      });

      function editTask(index) {
          const item = document.querySelectorAll(".task-item")[index];
          const text = item.querySelector(".flex-grow div").textContent.trim();
          const deadlineText = item.querySelector(".text-xs")?.textContent?.replace("⏰ ", "");
          let deadline = '';
          if (deadlineText) {
              const local = new Date(deadlineText);
              local.setMinutes(local.getMinutes() - local.getTimezoneOffset());
              deadline = local.toISOString().slice(0, 16);
          }
          document.getElementById("taskInput").value = text;
          document.getElementById("taskDeadline").value = deadline;
          document.getElementById("taskIndex").value = index;
          window.scrollTo({top: 0, behavior: 'smooth'});
      }

      function openConfirmModal(index) {
        document.getElementById("deleteIndexInput").value = index;
        document.getElementById("confirmModal").classList.remove("hidden");
      }

      function closeConfirmModal() {
        document.getElementById("confirmModal").classList.add("hidden");
      }
  </script>
</body>
</html>
