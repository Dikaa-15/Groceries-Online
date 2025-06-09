# 🛒 Groceries‑Online

**An online grocery storefront** built to simplify grocery shopping — browse, add to cart, and check out with ease.

---

## 🔎 Table of Contents

- [Demo](#-demo)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [📦 Installation](#-installation)
- [🚀 Usage](#-usage)
- [🧩 Project Structure](#-project-structure)
- [🤝 Contributing](#-contributing)
- [📄 License](#-license)

---

## 🎬 Demo

Here’s a screenshot or live demo link of your homepage:

![Homepage Screenshot]

*Optional: Insert link to deployed demo*

---

## ✅ Features

- 🛍️ Browse products by category  
- ➕ Add items to cart & update quantities  
- 💳 Checkout with simple form and order summary  
- 👤 User auth (register/login)  
- 📦 Order history/dashboard  
- ⚙️ (Future) Admin panel to manage inventory  

---

## 🛠️ Tech Stack

- **Frontend**: HTML, Tailwind CSS, Livewire  
- **Backend**: Laravel / Fillament
- **Database**: MySQL
- **Tools**: Git

---

## 📦 Installation

1. **Clone the repo**  
git clone https://github.com/Dikaa-15/Groceries-Online
cd Groceries-Online

`` Install Depedencies
composer install
npm install

`` Setup Environment
cp .env.example .env
php artisan key:generate

`` Migrate & seed
php artisan migrate --seed

`` Running
php artisan serve
npm run dev
