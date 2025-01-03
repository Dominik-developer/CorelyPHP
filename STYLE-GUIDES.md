# Style Guides for [Project Name]

This document outlines the coding and formatting standards to be followed when contributing to [Project Name].

## Table of Contents

- [General Guidelines](#general-guidelines)
- [Code Formatting](#code-formatting)
- [File Naming Conventions](#file-naming-conventions)
- [Commenting Standards](#commenting-standards)
- [Commit Message Guidelines](#commit-message-guidelines)

---

## General Guidelines

- Write clean, readable, and maintainable code.
- Avoid hardcoding values; use constants or configuration files instead.
- Ensure compatibility with the project's supported environments (e.g., browsers, frameworks, or runtimes).
- Test your code thoroughly before submitting.

---

## Code Formatting

### Indentation

- Use **2 spaces** for indentation.
- Avoid mixing tabs and spaces.

### Line Length

- Limit lines to **80-100 characters** when possible.

### Braces and Blocks

- Use braces for all control structures, even for single-line blocks.
  ```javascript
  // Good
  if (condition) {
      doSomething();
  }

  // Bad
  if (condition) doSomething();
