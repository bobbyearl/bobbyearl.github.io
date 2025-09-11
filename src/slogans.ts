const setupSlogans = (result: HTMLElement, refresh: HTMLButtonElement) => {
  const slogans = [
    'Not the guy from that movie.',
    'Yes, that is my name.',
    "No, I'm not a Nascar driver.",
    'Ricky Bobby is a funny movie.',
    'Like, `My Name Is`.',
  ];

  const writeSlogan = () => {
    const randomIndex = Math.floor(Math.random() * slogans.length);
    result.textContent = slogans[randomIndex];
  };

  refresh.addEventListener('click', writeSlogan);
  writeSlogan();
};

export default setupSlogans;
