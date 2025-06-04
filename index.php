<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaultify</title>
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="logo-Vaultify.png" type="image/x-icon">
    <meta name="theme-color" content="#111827">
    <meta property="og:title" content="Vaultify">
    <meta property="og:description" content="Vaultify: Simple, Secure Password Management Vaultify lets you store, manage, and protect your passwords with ease.Save: Store passwords, usernames, and notes securely.Generate: Create strong passwords instantly.Search: Find passwords quickly.Backup: Export or import passwords safely.Customize: Add colors for easy organization.Copy: Copy details with one click.Offline: Works without internet.Why Vaultify? It’s your digital safe—simple, secure, and always accessible. Start now and keep your passwords organized!">
    <meta property="og:image" content="https://masterworld.ir/Vaultify/logo-Vaultify.png">
    <meta property="og:url" content="https://masterworld.ir/Vaultify/">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Crypto-JS Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    
<style>
        body { font-family: 'Inter', sans-serif; }
        .password-masked { 
            font-family: monospace; 
            letter-spacing: 2px; 
        }
        
        /* Custom Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #1f2937;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #4b5563; 
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }
        
        ::-webkit-scrollbar-thumb:active {
            background: #9ca3af;
        }
        
        /* For Firefox */
        * {
            scrollbar-width: thin;
            scrollbar-color: #4b5563 #1f2937;
        }
        
        /* Smooth scrolling behavior */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-10 max-w-4xl">
        <!-- Header -->
        <header class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-blue-400 flex items-center" style="font-size: clamp(0.8rem, 2.7vw, 2.2rem);">
                <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                </svg>
                Password Manager
            </h1>
            <div class="flex space-x-2">
                <button id="importBtn" class="bg-[#1c293c] border-2 border-solid border-[#00c86a9c] shadow-[0px_0px_0px] tracking-[1.1px] hover:bg-blue-900 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Import
                </button>
                <button id="exportBtn" class="bg-[#00f06447] border-2 border-solid border-[#00c86ac2] shadow-[0px_0px_0px] tracking-[1.1px] hover:bg-green-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Export
                </button>
            </div>
            
        </header>

        <!-- Search Bar -->
        <div class="mb-6">
            <div class="relative">
                <input 
                    type="text" 
                    id="searchInput" 
                    placeholder="Search passwords..." 
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 pl-10 text-gray-100 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                >
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

<button id="btn-add-new-pass" style="
    border: 1px solid blue;
    padding: 12px;
    border-radius: 6px;
    background-color: #2563eb12;
" class="text-xl font-semibold mb-4 text-blue-400">
    Add New Password
</button>

<!-- فرم اضافه کردن پسورد -->
<div id="new-pass-form" class="bg-gray-800 rounded-lg p-6 mb-6 border border-gray-700" style="display: none;">
            <h2 class="text-xl font-semibold mb-4 text-blue-400">Add New Password</h2>
            <form id="passwordForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Title *</label>
                    <input 
                        type="text" 
                        id="titleInput" 
                        required 
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-gray-100 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        placeholder="e.g., Gmail, Facebook, Bank"
                    >
                </div>
                
                <div>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="usernameToggle" class="mr-2">
                        <label class="text-sm font-medium">Username</label>
                    </div>
                    <input 
                        type="text" 
                        id="usernameInput" 
                        disabled 
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-gray-100 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                        placeholder="Enter username or email"
                    >
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Password </label>
                    <div class="flex space-x-2">
                        <input 
                            type="" 
                            id="passwordInput" 
                            class="flex-1 bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-gray-100 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Enter password"
                        >
                        <button type="button" id="generateBtn" class="bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Generate
                        </button>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Notes</label>
                    <textarea 
                        id="notesInput" 
                        rows="3" 
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-gray-100 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        placeholder="Additional notes or details"
                    ></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Row Color</label>
                    <div class="flex space-x-2">
                        <input type="radio" name="rowColor" value="default" id="colorDefault" checked class="hidden">
                        <label for="colorDefault" class="w-8 h-8 bg-gray-700 border-2 border-gray-600 rounded-full cursor-pointer hover:border-blue-500"></label>
                        
                        <input type="radio" name="rowColor" value="blue" id="colorBlue" class="hidden">
                        <label for="colorBlue" class="w-8 h-8 bg-blue-700 border-2 border-gray-600 rounded-full cursor-pointer hover:border-blue-500"></label>
                        
                        <input type="radio" name="rowColor" value="green" id="colorGreen" class="hidden">
                        <label for="colorGreen" class="w-8 h-8 bg-green-700 border-2 border-gray-600 rounded-full cursor-pointer hover:border-blue-500"></label>
                        
                        <input type="radio" name="rowColor" value="purple" id="colorPurple" class="hidden">
                        <label for="colorPurple" class="w-8 h-8 bg-purple-700 border-2 border-gray-600 rounded-full cursor-pointer hover:border-blue-500"></label>
                        
                        <input type="radio" name="rowColor" value="red" id="colorRed" class="hidden">
                        <label for="colorRed" class="w-8 h-8 bg-red-700 border-2 border-gray-600 rounded-full cursor-pointer hover:border-blue-500"></label>
                        
                        <input type="radio" name="rowColor" value="yellow" id="coloryellow" class="hidden">
                        <label for="coloryellow" class="w-8 h-8 bg-yellow-700 border-2 border-gray-600 rounded-full cursor-pointer hover:border-blue-500"></label>
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                    Add Password
                </button>
            </form>
        </div>

        <!-- Password List -->
        <div id="passwordList" class="space-y-4">
            <!-- Password entries will be dynamically inserted here -->
        </div>
        
        <!-- Empty State -->
        <div id="emptyState" class="text-center py-12 text-gray-500 hidden">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <h3 class="text-xl font-medium mb-2">No passwords saved</h3>
            <p>Add your first password to get started</p>
        </div>
    </div>

    <!-- Hidden file input for import -->
    <input type="file" id="fileInput" accept=".json" class="hidden">

    <!-- Toast notifications -->
    <div id="toast" class="fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <span id="toastMessage"></span>
    </div>

    <script>
        // Fixed encryption key - embedded in code as requested
        const ENCRYPTION_KEY = '///////env_key////////';
        
        // Application state
        let passwords = [];
        let editingId = null;
        
        // DOM elements
        const passwordForm = document.getElementById('passwordForm');
        const titleInput = document.getElementById('titleInput');
        const usernameInput = document.getElementById('usernameInput');
        const usernameToggle = document.getElementById('usernameToggle');
        const passwordInput = document.getElementById('passwordInput');
        const notesInput = document.getElementById('notesInput');
        const generateBtn = document.getElementById('generateBtn');
        const searchInput = document.getElementById('searchInput');
        const passwordList = document.getElementById('passwordList');
        const emptyState = document.getElementById('emptyState');
        const exportBtn = document.getElementById('exportBtn');
        const importBtn = document.getElementById('importBtn');
        const fileInput = document.getElementById('fileInput');
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');

        // Initialize app
        document.addEventListener('DOMContentLoaded', function() {
            loadFromStorage();
            renderPasswords();
            registerServiceWorker();
        });

        // Service Worker registration
        function registerServiceWorker() {
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('sw.js')
                    .then(registration => console.log('SW registered:', registration))
                    .catch(error => console.log('SW registration failed:', error));
            }
        }

        // Username toggle functionality
        usernameToggle.addEventListener('change', function() {
            usernameInput.disabled = !this.checked;
            if (!this.checked) { 
                usernameInput.value = '';
            }
        });

        // Password generation
        generateBtn.addEventListener('click', function() {
            const charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
            let password = '';
            for (let i = 0; i < 12; i++) {
                password += charset.charAt(Math.floor(Math.random() * charset.length));
            }
            passwordInput.value = password;
        });

        // Form submission
        passwordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const title = titleInput.value.trim();
            const username = usernameToggle.checked ? usernameInput.value.trim() : '';
            const password = passwordInput.value.trim();
            const notes = notesInput.value.trim();
            const color = document.querySelector('input[name="rowColor"]:checked').value;
            
            if (!title) {
                showToast('Title are required', 'error');
                return;
            }
            
            const passwordEntry = {
                id: editingId || generateId(),
                title,
                username,
                password,
                notes,
                color,
                createdAt: editingId ? passwords.find(p => p.id === editingId).createdAt : new Date().toISOString(),
                updatedAt: new Date().toISOString()
            };
            
            if (editingId) {
                const index = passwords.findIndex(p => p.id === editingId);
                passwords[index] = passwordEntry;
                editingId = null;
                showToast('Password updated successfully');
            } else {
                passwords.push(passwordEntry);
                showToast('Password added successfully');
            }
            
            saveToStorage();
            renderPasswords();
            resetForm();
            //autoExport();
        });

        // Search functionality
        searchInput.addEventListener('input', function() {
            renderPasswords();
        });

        // Fuzzy search implementation
        function fuzzySearch(query, text) {
            if (!query) return 1;
            
            query = query.toLowerCase().replace(/\s+/g, '');
            text = text.toLowerCase().replace(/\s+/g, '');
            
            if (text.includes(query)) return 0.9;
            
            let score = 0;
            let queryIndex = 0;
            
            for (let i = 0; i < text.length && queryIndex < query.length; i++) {
                if (text[i] === query[queryIndex]) {
                    score++;
                    queryIndex++;
                }
            }
            
            return queryIndex === query.length ? score / query.length * 0.7 : 0;
        }

        // Filter passwords based on search
        function filterPasswords() {
            const query = searchInput.value.trim();
            if (!query) return passwords;
            
            return passwords
                .map(password => {
                    const titleScore = fuzzySearch(query, password.title);
                    const usernameScore = fuzzySearch(query, password.username);
                    const notesScore = fuzzySearch(query, password.notes);
                    const maxScore = Math.max(titleScore, usernameScore, notesScore);
                    
                    return { ...password, searchScore: maxScore };
                }) 
                .filter(password => password.searchScore >= 0.5)
                .sort((a, b) => b.searchScore - a.searchScore);
        }

        // Render passwords
        function renderPasswords() {
            const filteredPasswords = filterPasswords();
            
            if (filteredPasswords.length === 0) {
                document.getElementById("btn-add-new-pass").style.display = "none";
                document.getElementById("new-pass-form").style.display = "block";
                passwordList.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }

         document.getElementById("new-pass-form").style.display = "none";
         document.getElementById("btn-add-new-pass").style.display = "block";
            emptyState.classList.add('hidden');
            
            passwordList.innerHTML = filteredPasswords.map(password => `
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 ${getColorClass(password.color)} transition-all duration-200">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-lg font-semibold text-blue-400">${escapeHtml(password.title)}</h3>
                        <div class="flex space-x-2">
                            <button onclick="editPassword('${password.id}')" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="deletePassword('${password.id}')" class="text-red-400 hover:text-red-300 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    ${password.username ? `
                        <div class="mb-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-400">Username:</span>
                                <button onclick="copyToClipboard('${escapeHtml(password.username)}', 'Username')" class="text-blue-400 hover:text-blue-300 text-sm transition-colors">Copy</button>
                            </div>
                            <p class="text-gray-300 break-all">${escapeHtml(password.username)}</p>
                        </div>
                    ` : ''}
                    
                    <div class="mb-2">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-400">Password:</span>
                            <button onclick="copyToClipboard('${escapeHtml(password.password)}', 'Password')" class="text-blue-400 hover:text-blue-300 text-sm transition-colors">Copy</button>
                        </div>
                        <p class="text-gray-300 password-masked">${escapeHtml(password.password)}</p>
                    </div>
                    
                    ${password.notes ? `
                        <div class="mb-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-400">Notes:</span>
                                <button onclick="copyToClipboard('${escapeHtml(password.notes)}', 'Notes')" class="text-blue-400 hover:text-blue-300 text-sm transition-colors">Copy</button>
                            </div>
                            <p class="text-gray-300 text-sm">${escapeHtml(password.notes)}</p>
                        </div>
                    ` : ''}
                    
                    <div class="text-xs text-gray-500 mt-3">
                        Created: ${new Date(password.createdAt).toLocaleDateString()}
                        ${password.updatedAt !== password.createdAt ? ` • Updated: ${new Date(password.updatedAt).toLocaleDateString()}` : ''}
                    </div>
                </div>
            `).join('');
        }

        // Get color class for password entry
        function getColorClass(color) {
            const colorMap = {
                blue: 'bg-blue-900 bg-opacity-20 border-blue-700',
                green: 'bg-green-900 bg-opacity-20 border-green-700',
                purple: 'bg-purple-900 bg-opacity-20 border-purple-700',
                red: 'bg-red-900 bg-opacity-20 border-red-700',
                yellow: 'bg-yellow-900 bg-opacity-20 border-yellow-700',
                default: ''
            };
            return colorMap[color] || '';
        }

        // Copy to clipboard
        function copyToClipboard(text, type) {
            navigator.clipboard.writeText(text).then(() => {
                showToast(`${type} copied to clipboard`);
            }).catch(() => {
                showToast('Failed to copy to clipboard', 'error');
            });
        }

        // Edit password
        function editPassword(id) {
            const password = passwords.find(p => p.id === id);
            if (!password) return;
            
            editingId = id;
            titleInput.value = password.title;
            
            document.getElementById("new-pass-form").style.display = "block";
             
            if (password.username) {
                usernameToggle.checked = true;
                usernameInput.disabled = false;
                usernameInput.value = password.username;
            } else {
                usernameToggle.checked = false;
                usernameInput.disabled = true;
                usernameInput.value = '';
            }
                    
            passwordInput.value = password.password;
            notesInput.value = password.notes;
            
            document.querySelector(`input[name="rowColor"][value="${password.color}"]`).checked = true;
            
            titleInput.scrollIntoView({ behavior: 'smooth' });
            titleInput.focus();
        }
 
        // Delete password
// Delete password
function deletePassword(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            passwords = passwords.filter(p => p.id !== id);
            saveToStorage();
            renderPasswords();
            // autoExport();
            Swal.fire(
                'Deleted!',
                'Your password has been deleted.',
                'success'
            );
        }
    });
}


        // Export functionality
        exportBtn.addEventListener('click', function() {
            exportData();
        });

// این توابع را در بخش <script> خود قرار دهید.
// مطمئن شوید که متغیرهای ENCRYPTION_KEY، passwords و تابع showToast از قبل در کد شما تعریف شده‌اند.

function isRunningInWebView() {
    const userAgent = navigator.userAgent || navigator.vendor || window.opera;
    // نشانه‌های رایج WebView در User Agent (به خصوص 'wv' برای اندروید)
    if (/(wv|WebView)/i.test(userAgent)) {
        return true;
    }
    // تشخیص دقیق WebView در iOS فقط با User Agent دشوار است.
    // اگر راهی برای تزریق یک متغیر از اپلیکیشن نیتیو دارید (مثلا window.isMyAppWebView = true)، آن قابل اعتمادتر است.
    return false; 
}

async function exportData() {
    try {
        // این بخش مشابه کد اصلی شما برای آماده‌سازی داده‌ها است
        const dataToExport = {
            passwords: passwords, // مطمئن شوید passwords در دسترس است
            exportDate: new Date().toISOString(),
            version: '1.0'
        };

        // مطمئن شوید CryptoJS و ENCRYPTION_KEY در دسترس هستند
        const encrypted = CryptoJS.AES.encrypt(JSON.stringify(dataToExport), ENCRYPTION_KEY).toString();
        const fileName = `Vaultify_${new Date().toISOString().split('T')[0]}.json`;

        const isInWebView = isRunningInWebView();
        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

 
        if (isInWebView&&1==2) {

           const form = document.createElement('form');
            form.method = 'POST';
            // اسکریپت PHP در همین فایل index.php است
            form.action = ''; // یا مسیر کامل اگر نیاز است: 'https://masterworld.ir/Vaultify/index.php'
            
            const dataInput = document.createElement('input');
            dataInput.type = 'hidden';
            dataInput.name = 'encryptedData';
            dataInput.value = encrypted;
            form.appendChild(dataInput);

            const fileNameInput = document.createElement('input');
            fileNameInput.type = 'hidden';
            fileNameInput.name = 'fileName';
            fileNameInput.value = fileName;
            form.appendChild(fileNameInput);

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
            // showToast('درخواست دانلود به سرور ارسال شد.', 'success'); // تابع showToast شم


        } else {
            // حالت مرورگر استاندارد (کد قبلی شما با کمی اصلاح برای خوانایی)
            const blob = new Blob([encrypted], { type: 'application/json' });
            
            // ابتدا بررسی قابلیت اشتراک‌گذاری فایل در موبایل
            if (isMobile && navigator.share && typeof navigator.canShare === 'function' && navigator.canShare({ files: [new File([blob], fileName, { type: 'application/json' })] })) {
                const fileToShare = new File([blob], fileName, { type: 'application/json' });
                try {
                    await navigator.share({
                        title: 'خروجی اطلاعات Vaultify', // عنوان شما
                        text: 'فایل داده‌های رمزنگاری شده شما.', // متن شما
                        files: [fileToShare],
                    });
                    // showToast('اطلاعات با موفقیت اشتراک‌گذاری شد.', 'success'); // تابع showToast شما
                } catch (err) {
                    // اگر اشتراک‌گذاری لغو شد یا با خطا مواجه شد، تلاش برای دانلود مستقیم
                    // showToast('اشتراک‌گذاری لغو شد یا ناموفق بود. تلاش برای دانلود مستقیم...', 'warning'); // تابع showToast شما
                    triggerBrowserDownload(blob, fileName); // فال‌بک به دانلود مستقیم
                }
            } else {
                // مرورگر دسکتاپ یا موبایل بدون قابلیت اشتراک‌گذاری فایل
                triggerBrowserDownload(blob, fileName);
            }
        }
    } catch (error) {
        console.error('خطا در خروجی گرفتن: ', error);
        // showToast(`خطا در خروجی گرفتن اطلاعات: ${error.message}`, 'error'); // تابع showToast شما
    }
}

// تابع کمکی برای دانلود مستقیم در مرورگر (بخش else کد اصلی شما)
function triggerBrowserDownload(blob, fileName) {
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.style.display = 'none';
    a.href = url;
    a.download = fileName;
    document.body.appendChild(a);
    a.click();
    setTimeout(() => { // تاخیر برای اطمینان از شروع دانلود قبل از حذف لینک
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        // showToast('فایل با موفقیت برای دانلود آماده شد.', 'success'); // تابع showToast شما
    }, 100);
}


        // Import functionality
        importBtn.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    const encryptedData = e.target.result;
                    const decrypted = CryptoJS.AES.decrypt(encryptedData, ENCRYPTION_KEY);
                    const decryptedString = decrypted.toString(CryptoJS.enc.Utf8);
                    
                    if (!decryptedString) {
                        throw new Error('Invalid decryption');
                    }
                    
                    const importedData = JSON.parse(decryptedString);
                    
                    if (importedData.passwords && Array.isArray(importedData.passwords)) {
                        passwords = importedData.passwords;
                        saveToStorage();
                        renderPasswords();
                        showToast('Data imported successfully');
                    } else {
                        throw new Error('Invalid data structure');
                    }
                } catch (error) {
                    showToast('Failed to import data. Invalid file.', 'error');
                }
            };
            reader.readAsText(file);
            
            // Reset file input
            fileInput.value = '';
        });

        // Auto export after changes
        function autoExport() {
            // Only auto-export if user has passwords to avoid empty exports
            if (passwords.length > 0) {
                setTimeout(exportData, 1000);
            }
        }

        // Storage functions
        function saveToStorage() {
            try {
                const encrypted = CryptoJS.AES.encrypt(JSON.stringify(passwords), ENCRYPTION_KEY).toString();
                localStorage.setItem('Vaultify', encrypted);
            } catch (error) {
                showToast('Failed to save data to localStorage', 'error');
            }
        }

        function loadFromStorage() {
            try {
                const encrypted = localStorage.getItem('Vaultify');
                if (encrypted) {
                    const decrypted = CryptoJS.AES.decrypt(encrypted, ENCRYPTION_KEY);
                    const decryptedString = decrypted.toString(CryptoJS.enc.Utf8);
                    
                    if (decryptedString) {
                        passwords = JSON.parse(decryptedString);
                    }
                }
            } catch (error) {
                showToast('Failed to load data from localStorage', 'error');
                passwords = [];
            }
        }

        // Utility functions
        function generateId() {
            return Date.now().toString(36) + Math.random().toString(36).substr(2);
        }

        function resetForm() {
            passwordForm.reset();
            usernameInput.disabled = true;
            document.querySelector('input[name="rowColor"][value="default"]').checked = true;
            editingId = null;
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML; 
        }

        function showToast(message, type = 'success') {
            toastMessage.textContent = message;
            toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition-transform duration-300 z-50 ${
                type === 'error' ? 'bg-red-600' : 'bg-green-600'
            } text-white`;
            
            toast.style.transform = 'translateX(0)';
            
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
            }, 3000);
        }

        // Color selection handling
        document.querySelectorAll('input[name="rowColor"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('label[for^="color"]').forEach(label => {
                    label.classList.remove('border-blue-500');
                    label.classList.add('border-gray-600');
                });
                
                if (this.checked) {
                    document.querySelector(`label[for="${this.id}"]`).classList.remove('border-gray-600');
                    document.querySelector(`label[for="${this.id}"]`).classList.add('border-blue-500');
                }
            });
        });

    document.getElementById("btn-add-new-pass").addEventListener("click", function () {
        var form = document.getElementById("new-pass-form");
        // اگر پنهان بود، نشان بده و برعکس
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }); 

    </script>
</body>
</html>
