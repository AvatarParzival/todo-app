const apiBase = 'api/';
const taskInput = document.getElementById('taskInput');
const addTaskForm = document.getElementById('addTaskForm');
const taskList = document.getElementById('taskList');

document.addEventListener('DOMContentLoaded', fetchTasks);

addTaskForm.addEventListener('submit', async (e) => {
  e.preventDefault();
  const name = taskInput.value.trim();
  if (!name) return;

  const res = await fetch(apiBase + 'add_task.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({ task_name: name })
  });
  const data = await res.json();
  if (data.error) { alert(data.error); return; }

  appendTaskDom(data.id, data.task_name);
  taskInput.value = '';
});

taskList.addEventListener('click', async (e) => {
  if (!e.target.classList.contains('delete-btn')) return;
  const id = e.target.dataset.id;

  await fetch(apiBase + 'delete_task.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({ id })
  });

  document.querySelector(`li[data-id='${id}']`).remove();
});

async function fetchTasks() {
  const res = await fetch(apiBase + 'get_tasks.php');
  const tasks = await res.json();
  tasks.forEach(t => appendTaskDom(t.id, t.task_name));
}

function appendTaskDom(id, name) {
  const li = document.createElement('li');
  li.className = 'list-group-item d-flex justify-content-between align-items-center';
  li.dataset.id = id;
  li.innerHTML = `
    <span>${name}</span>
    <button class="btn btn-outline-danger btn-sm delete-btn" data-id="${id}">Delete</button>
  `;
  taskList.appendChild(li);
}