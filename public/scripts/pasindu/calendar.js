const calendar = document.getElementById('dates');
const monthYear = document.getElementById('month-year');
const prevMonth = document.getElementById('prev-month');
const nextMonth = document.getElementById('next-month');

let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

const events = [];

function generateCalendar(month, year) {
  calendar.innerHTML = '';
  monthYear.textContent = new Date(year, month).toLocaleString('default', { month: 'long', year: 'numeric' });

  const firstDay = new Date(year, month, 1).getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  for (let i = 0; i < firstDay; i++) {
    calendar.innerHTML += '<div></div>';
  }

  for (let day = 1; day <= daysInMonth; day++) {
    const date = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
    const event = events.find(e => e.date === date);

    const dayElement = document.createElement('div');
    dayElement.innerHTML = `
      <span>${day}</span>
      ${event ? `<span>${event.event}</span>` : ''}
    `;
    dayElement.className = 'calendar-day';
    dayElement.dataset.date = date;

    dayElement.addEventListener('click', () => {
      window.location.href = `/visit-details?date=${date}`;
    });

    calendar.appendChild(dayElement);
  }
}

prevMonth.addEventListener('click', () => {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  generateCalendar(currentMonth, currentYear);
});

nextMonth.addEventListener('click', () => {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  generateCalendar(currentMonth, currentYear);
});

generateCalendar(currentMonth, currentYear);
function generateCalendar(month, year) {
  calendar.innerHTML = '';
  monthYear.textContent = new Date(year, month).toLocaleString('default', { month: 'long', year: 'numeric' });

  const firstDay = new Date(year, month, 1).getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  for (let i = 0; i < firstDay; i++) {
    calendar.innerHTML += '<div></div>';
  }

  for (let day = 1; day <= daysInMonth; day++) {
    const date = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
    const event = events.find(e => e.date === date);

    const dayElement = document.createElement('div');
    dayElement.innerHTML = `
      <span>${day}</span>
      ${event ? `<span>${event.event}</span>` : ''}
    `;
    dayElement.className = 'calendar-day';
    dayElement.dataset.date = date;

    dayElement.addEventListener('click', () => {
      window.location.href = `/calendarVisit?date=${date}`;
    });

    calendar.appendChild(dayElement);
  }
}

