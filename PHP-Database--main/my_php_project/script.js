document.addEventListener('DOMContentLoaded', () => {
  const members = document.querySelectorAll('.team-member');

  members.forEach(member => {
      member.addEventListener('click', () => {
          alert(`You clicked on ${member.querySelector('h3').textContent}`);
      });

    
      const icons = member.querySelectorAll('.icon');
      icons.forEach(icon => {
          icon.addEventListener('click', (e) => {
              e.stopPropagation(); 
              alert('Redirecting to Social Media!');
          });
      });
  });
});
