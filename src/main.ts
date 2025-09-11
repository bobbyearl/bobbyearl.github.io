import themeSelector from "./themes.ts";
import setupSlogans from "./slogans.ts";

themeSelector();
setupSlogans(
  document.querySelector<HTMLHeadingElement>("h2")!,
  document.querySelector<HTMLButtonElement>("button")!,
);
