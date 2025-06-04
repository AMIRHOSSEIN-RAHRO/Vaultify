# Vaultify - Password Manager

Vaultify is a client-side, offline-first password manager designed for simplicity and security. It allows you to store, manage, and protect your passwords and sensitive information directly in your browser.

## ✨ Features

* 🔐 **Secure Storage**: Store passwords, usernames, and notes. All data is encrypted locally in your browser.
* 🔑 **Password Generation**: Instantly create strong, random passwords.
* 🔍 **Fuzzy Search**: Quickly find the credentials you need with an intelligent search.
* 💾 **Backup & Restore**:
    * **Export**: Securely export your encrypted data as a JSON file.
    * **Import**: Easily import your previously exported data.
* 🎨 **Customization**: Organize entries by assigning different colors to rows.
* 📋 **One-Click Copy**: Copy usernames, passwords, or notes to the clipboard with a single click.
* 🌐 **Offline Functionality**: Works entirely offline as a Progressive Web App (PWA) after the first load.
* 📱 **Responsive Design**: User-friendly interface that adapts to different screen sizes.
* 🔔 **Notifications**: Get feedback on actions with toast notifications.
* 🛡️ **Data Encryption**: Utilizes AES encryption via CryptoJS to protect your data.
* 🗑️ **Secure Delete**: Confirm password deletions with a clear prompt (using SweetAlert2).

## 💻 Technologies Used

* **Frontend**: HTML5, CSS3, Vanilla JavaScript
* **Styling**: Tailwind CSS, Custom CSS for scrollbars and theming
* **Encryption**: CryptoJS (AES)
* **Alerts/Modals**: SweetAlert2
* **Fonts**: Google Fonts (Inter)
* **Offline Capability**: Progressive Web App (PWA) using Service Workers

## 🚀 How to Use

1.  **Directly in Browser**:
    * Download the repository files.
    * Open the `index.php` (or `index.html` if you rename it) file in a modern web browser (like Chrome, Firefox, Edge).
    * No web server is strictly required for the core functionality as it's client-side.
2.  **Hosted**:
    * Deploy the files to any static web hosting service or a web server.
    * Access it via the URL.

## ⚙️ How It Works

Vaultify operates entirely on the client-side.
* **Data Storage**: Your password entries are stored in the browser's `localStorage`.
* **Encryption**: Before saving to `localStorage` or exporting, your data is encrypted using AES (Advanced Encryption Standard) with a **fixed encryption key** embedded in the JavaScript code. The same key is used for decryption when loading data or importing.
* **Export/Import**: Data is exported as an encrypted JSON file. This file can be used as a backup or to transfer your vault to another browser/device where you use Vaultify.

## ⚠️ Security Considerations

* **Fixed Encryption Key**: The AES encryption key (`ENCRYPTION_KEY`) is hardcoded directly into the JavaScript source file (`index.php`).
    * **Implication**: Anyone with access to the source code can find this key. If an attacker obtains your `localStorage` data or an exported JSON file, they can decrypt it using this key.
    * **Mitigation**: This design prioritizes simplicity for an offline, client-side tool. For higher security needs, especially if the source code is publicly accessible or if there's a risk of the encrypted data being compromised, a user-derived key (e.g., from a master password not stored directly) would be a more robust approach. However, this would also add complexity to the key management and recovery process.
* **Client-Side Security**: Being fully client-side, the security of your data relies heavily on the security of the device and browser where Vaultify is used. Avoid using it on public or compromised computers.
* **XSS (Cross-Site Scripting)**: The application uses `escapeHtml` function to sanitize text content before inserting it into the DOM, which is a good practice to prevent XSS vulnerabilities from user-supplied data like titles or notes.

## 🛠️ Code Overview

* `index.php`: The main HTML file containing the structure, styles (Tailwind CSS and custom), and all the JavaScript logic for the password manager. Includes:
    * DOM manipulation for UI updates.
    * Event listeners for user interactions (form submission, search, import/export, etc.).
    * Encryption/Decryption functions using `CryptoJS`.
    * Functions for saving to and loading from `localStorage`.
    * Password generation, fuzzy search logic.
    * PWA Service Worker registration.
* `manifest.json` (referenced): Defines the PWA properties.
* `sw.js` (referenced): The service worker script for offline capabilities. (Note: The content of `sw.js` and `manifest.json` are not provided in the `index.php` but are essential for PWA functionality).

## 🚀 Potential Future Enhancements

* Implement user-derived encryption keys (e.g., from a master password) instead of a fixed key.
* Add options for more complex password generation rules.
* Introduce password strength indicators.
* Allow tagging or categorizing passwords.
* Browser extension for auto-fill capabilities.
* Cloud synchronization options (with end-to-end encryption).

## 🤝 Contributing

Contributions are welcome! If you have suggestions for improvements or find any bugs, please feel free to open an issue or submit a pull request.

1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  Push to the Branch (`git push origin feature/AmazingFeature`)
5.  Open a Pull Request

## 📜 License

This project is open-source. Refer to the `LICENSE` file for more details (if one is added). You are free to use, modify, and distribute it as you see fit.

---

Keep your digital life secure with Vaultify!
