# 🛒 Shoppia

Shoppia একটি সম্পূর্ণ ফিচারড ই-কমার্স ওয়েব অ্যাপ্লিকেশন, যেখানে Laravel, Vue.js এবং Inertia.js ব্যবহার করে একটি আধুনিক ও ইউজার-ফ্রেন্ডলি শপিং অভিজ্ঞতা তৈরি করা হয়েছে।

## 🧰 প্রযুক্তি সমূহ

- 🔧 **Backend:** Laravel (UUID ভিত্তিক সম্পর্ক)
- 🎨 **Frontend:** Vue 3 + Inertia.js
- 🗃 **Database:** MySQL
- 🖼 **File Storage:** Public disk (Slider/Images)
- 🧪 **Authentication:** Laravel Breeze

## 🚀 বৈশিষ্ট্যসমূহ

- 🔍 ক্যাটেগরি, সাব-ক্যাটেগরি ও ব্র্যান্ড অনুযায়ী প্রোডাক্ট ফিল্টার
- 🖼 হোমপেজে স্লাইডার, ফ্ল্যাশ সেল, বেস্ট সেলিং প্রোডাক্ট
- ⏳ ফ্ল্যাশ সেলে ডাইনামিক টাইম কাউন্টডাউন
- 📦 প্রোডাক্ট ম্যানেজমেন্ট (CRUD)
- 📁 Laravel Storage:link ব্যবহারে ইমেজ সংযুক্তি
- 📑 SEO বান্ধব slug ব্যবহারে রাউটিং


> (এখানে আপনার অ্যাপের ২-৩টি স্ক্রিনশট যুক্ত করুন)

## 🛠️ ইনস্টলেশন গাইড

```bash
git clone https://github.com/sahinislam101/Shoppia.git
cd Shoppia

# Composer dependency ইনস্টল
composer install

# NPM dependency ইনস্টল
npm install && npm run dev

# .env কনফিগার করুন
cp .env.example .env
php artisan key:generate

# ডাটাবেজ তৈরি করুন এবং মাইগ্রেশন চালান
php artisan migrate --seed

# Storage link তৈরি করুন
php artisan storage:link

# সার্ভার রান করুন
php artisan serve
npm run dev
