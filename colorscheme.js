document.addEventListener('click', async event => {
  if (!event.target.matches('a.colorscheme')) return;

  event.preventDefault();

  if (!navigator.clipboard) {
    // Clipboard API not available
    return;
  }

  const text = event.target.innerText
  try {
    await navigator.clipboard.writeText(text);
  } catch (err) {
    console.error('Failed to copy!', err)
  }
});
