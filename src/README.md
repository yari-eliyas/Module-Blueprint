# 🧩 Module Blueprint for Laravel

**A powerful, lightweight, and customizable modular scaffolding package for Laravel applications.**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/e-yari/module-blueprint.svg?style=flat-square)](https://packagist.org/packages/e-yari/module-blueprint)
[![Total Downloads](https://img.shields.io/packagist/dt/e-yari/module-blueprint.svg?style=flat-square)](https://packagist.org/packages/e-yari/module-blueprint)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)

---

## 📖 Introduction / معرفی

**English:**  
Module Blueprint is a custom scaffolding package that helps you organize your Laravel applications into **modular structures**. With a single Artisan command, you can create a complete module with its own **Controllers**, **Models**, **Migrations**, **Routes**, and more — all following a clean, maintainable architecture.

No more messy `app/` directories! Keep your codebase **clean**, **scalable**, and **team-friendly**.

**فارسی:**  
ماژول بلوپرینت یک پکیج داربست‌ساز سفارشی است که به شما کمک می‌کند پروژه‌های لاراول خود را به ساختار **ماژولار** سازماندهی کنید. با یک دستور ساده آرتیزان، می‌توانید یک ماژول کامل با **کنترلرها**، **مدل‌ها**، **مایگریشن‌ها**، **مسیرها** و موارد دیگر ایجاد کنید — همه بر اساس یک معماری تمیز و قابل نگهداری.

دیگر خبری از پوشه‌های شلوغ `app/` نیست! کدهای خود را **تمیز**، **مقیاس‌پذیر** و **دوست‌دار تیم** نگه دارید.

---

## ✨ Features / ویژگی‌ها

**English:**
- ✅ **One-Command Module Generation** – Create full modules in seconds.
- ✅ **Customizable Structure** – Includes `Controller`, `Models`, `Migrate`, `Router`, `Services`, `Helper`, and `Validator` directories.
- ✅ **Automated Migration Files** – Generates timestamped migration files automatically.
- ✅ **PSR-4 Compliant** – Follows Laravel and PHP standards.
- ✅ **Lightweight & Fast** – No unnecessary dependencies, minimal overhead.
- ✅ **No External Package Conflicts** – Works cleanly with any Laravel project.
- ✅ **Developer Friendly** – Clear naming, organized structure, and extensible code.

**فارسی:**
- ✅ **تولید ماژول با یک دستور** – ماژول‌های کامل را در چند ثانیه بسازید.
- ✅ **ساختار قابل سفارشی‌سازی** – شامل پوشه‌های `Controller`، `Models`، `Migrate`، `Router`، `Services`، `Helper` و `Validator`.
- ✅ **فایل‌های مایگریشن خودکار** – فایل‌های مایگریشن با تاریخ به‌طور خودکار تولید می‌شوند.
- ✅ **مطابق با استاندارد PSR-4** – پیروی از استانداردهای لاراول و پی‌اچ‌پی.
- ✅ **سبک و سریع** – بدون وابستگی‌های اضافی و سربار کم.
- ✅ **بدون تداخل با پکیج‌های دیگر** – به‌صورت تمیز با هر پروژه‌ی لاراول کار می‌کند.
- ✅ **دوست‌دار توسعه‌دهنده** – نام‌گذاری شفاف، ساختار منظم و کد قابل گسترش.

---

## 📋 Requirements / نیازمندی‌ها

- PHP `^8.1`
- Laravel `^10.0` | `^11.0`
- Composer `^2.0`

---

## 🔧 Installation / نصب

**English:**

### Step 1: Require the package via Composer
```bash
composer require e-yari/module-blueprint
