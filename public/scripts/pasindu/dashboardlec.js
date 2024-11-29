// Bar Chart: Internship Placements
const barChartCtx = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(barChartCtx, {
  type: 'bar',
  data: {
    labels: ['WSO2', 'cisco', '99x', 'virtusa','IFS'],
    datasets: [
      {
        label: 'CS',
        data: [10, 17, 15, 20, 14],
        backgroundColor: '#007bff',
      },
      {
        label: 'IS',
        data: [8, 15, 12, 18, 10],
        backgroundColor: '#80d4ff',
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: true }
    },
    scales: {
      y: { beginAtZero: true }
    }
  }
});

// Calendar Logic
const calendar = document.getElementById('dates');
const monthYear = document.getElementById('month-year');
const prevMonth = document.getElementById('prev-month');
const nextMonth = document.getElementById('next-month');

let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

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
    const dayElement = document.createElement('div');
    dayElement.textContent = day;
    dayElement.dataset.date = date;

    dayElement.addEventListener('click', () => {
      alert(`You clicked on ${date}`);
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
