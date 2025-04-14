  const adminName = document.getElementById('adminName').textContent.trim();
  const imageURL = ''; // Leave empty or set to null if image is missing
  const container = document.getElementById('profileImageContainer');

  if (imageURL) {
    const img = document.createElement('img');
    img.src = imageURL;
    img.alt = 'Profile';
    container.appendChild(img);
  } else {
    const initials = adminName.split(' ')
      .map(word => word[0])
      .join('')
      .toUpperCase();
    container.textContent = initials;
  }

