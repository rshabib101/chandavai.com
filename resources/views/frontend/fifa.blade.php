<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ফিফা বিশ্বকাপ ২০২৬ - সম্পূর্ণ ফিক্সচার (বাংলাদেশ সময়)</title>
    <!-- Tailwind CSS for modern and sleek UI -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Google Fonts for Bengali -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Hind Siliguri', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>

<body class="text-slate-100 min-h-screen py-8 px-4 sm:px-6 lg:px-8">

    <!-- Header Section -->
    <div class="max-w-4xl mx-auto text-center mb-10">
        <div class="inline-block bg-amber-500/10 text-amber-400 text-sm px-4 py-1.5 rounded-full font-semibold border border-amber-500/20 mb-3 tracking-wide uppercase">
            ⚽ FIFA World Cup 2026
        </div>
        <h1 class="text-3xl sm:text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white via-slate-200 to-amber-400">
            মেগা ম্যাচ ফিক্সচার
        </h1>
        <p class="text-slate-400 mt-2 text-sm sm:text-base">বাংলাদেশ সময় (BST) অনুযায়ী সাজানো এবং সার্চেবল ইন্টারফেস</p>
    </div>

    <!-- Search & Filter Controls -->
    <div class="max-w-4xl mx-auto mb-6 flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <input type="text" id="searchInput" placeholder="দল বা গ্রুপ খুঁজুন (যেমন: Argentina, Brazil, Group A)..."
                class="w-full bg-slate-900/60 border border-slate-700/60 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-amber-500 text-white placeholder-slate-500 transition-all">
        </div>
        <div class="flex gap-2">
            <button onclick="filterMatches('all')" id="btn-all" class="px-4 py-2 text-sm font-semibold rounded-xl bg-amber-500 text-slate-950 transition-all cursor-pointer">সব ম্যাচ</button>
            <button onclick="filterMatches('Argentina')" id="btn-arg" class="px-4 py-2 text-sm font-semibold rounded-xl bg-slate-800 hover:bg-slate-700 transition-all cursor-pointer">আর্জেন্টিনা</button>
            <button onclick="filterMatches('Brazil')" id="btn-bra" class="px-4 py-2 text-sm font-semibold rounded-xl bg-slate-800 hover:bg-slate-700 transition-all cursor-pointer">ব্রাজিল</button>
        </div>
    </div>

    <!-- Fixture Container -->
    <div class="max-w-4xl mx-auto space-y-4" id="fixtureContainer">
        <!-- JavaScript এর মাধ্যমে এখানে ম্যাচ কার্ডগুলো লোড হবে -->
    </div>

    <!-- Footer -->
    <div class="max-w-4xl mx-auto text-center mt-12 text-xs text-slate-500 border-t border-slate-800/60 pt-6">
        * খেলাল সময় পরিবর্তন সাপেক্ষে আপডেট হতে পারে। দিবাগত রাতের ম্যাচগুলোর ক্ষেত্রে তারিখ খেয়াল রাখুন।
    </div>

    <!-- JavaScript Data and Logic -->
    <script>
        // ম্যাচের ডাটাবেজ (বাংলাদেশ সময় ও সঠিক তারিখ সহ)
        const matches = [{
                id: 1,
                date: "১২ জুন, ২০২৬",
                day: "শুক্রবার (১১ জুন দিবাগত রাত)",
                team1: "মেক্সিকো",
                team2: "সাউথ আফ্রিকা",
                flag1: "🇲🇽",
                flag2: "🇿🇦",
                group: "গ্রুপ A",
                time: "রাত ০১:০০ টা",
                venue: "মেক্সিকো সিটি"
            },
            {
                id: 2,
                date: "১২ জুন, ২০২৬",
                day: "শুক্রবার",
                team1: "সাউথ কোরিয়া",
                team2: "চেক প্রজাতন্ত্র",
                flag1: "🇰🇷",
                flag2: "🇨🇿",
                group: "গ্রুপ A",
                time: "সকাল ০৮:০০ টা",
                venue: "জাপোপন"
            },
            {
                id: 3,
                date: "১৩ জুন, ২০২৬",
                day: "শনিবার (১২ জুন দিবাগত রাত)",
                team1: "কানাডা",
                team2: "বসনিয়া",
                flag1: "🇨🇦",
                flag2: "🇧🇦",
                group: "গ্রুপ B",
                time: "রাত ০১:০০ টা",
                venue: "টরোন্টো"
            },
            {
                id: 4,
                date: "১৩ জুন, ২০২৬",
                day: "শনিবার",
                team1: "ইউএসএ",
                team2: "প্যারাগুয়ে",
                flag1: "🇺🇸",
                flag2: "🇵🇾",
                group: "গ্রুপ D",
                time: "সকাল ০৭:০০ টা",
                venue: "লস অ্যাঞ্জেলেস"
            },
            {
                id: 5,
                date: "১৪ জুন, ২০২৬",
                day: "রবিবার (১৩ জুন দিবাগত রাত)",
                team1: "ব্রাজিল",
                team2: "মরক্কো",
                flag1: "🇧🇷",
                flag2: "🇲🇦",
                group: "গ্রুপ C",
                time: "রাত ০১:০০ টা",
                venue: "নিউ ইয়র্ক"
            },
            {
                id: 6,
                date: "১৪ জুন, ২০২৬",
                day: "রবিবার",
                team1: "জার্মানি",
                team2: "কুরাসাও",
                flag1: "🇩🇪",
                flag2: "🇨🇼",
                group: "গ্রুপ E",
                time: "রাত ১১:০০ টা",
                venue: "হিউস্টন"
            },
            {
                id: 7,
                date: "১৭ জুন, ২০২৬",
                day: "বুধবার (১৬ জুন দিবাগত রাত)",
                team1: "ফ্রান্স",
                team2: "সেনেগাল",
                flag1: "🇫🇷",
                flag2: "🇸🇳",
                group: "গ্রুপ I",
                time: "রাত ০১:০০ টা",
                venue: "নিউ ইয়র্ক"
            },
            {
                id: 8,
                date: "১৭ জুন, ২০২৬",
                day: "বুধবার",
                team1: "আর্জেন্টিনা",
                team2: "আলজেরিয়া",
                flag1: "🇦🇷",
                flag2: "🇩🇿",
                group: "গ্রুপ J",
                time: "সকাল ০৭:০০ টা",
                venue: "কানসাস সিটি"
            },
            {
                id: 9,
                date: "১৮ জুন, ২০২৬",
                day: "বৃহস্পতিবার (১৭ জুন দিবাগত রাত)",
                team1: "ইংল্যান্ড",
                team2: "ক্রোয়েশিয়া",
                flag1: "🏴󠁧󠁢󠁥󠁮󠁧󠁿",
                flag2: "🇭🇷",
                group: "গ্রুপ L",
                time: "রাত ০২:০০ টা",
                venue: "ডালাস"
            },
            {
                id: 10,
                date: "২০ জুন, ২০২৬",
                day: "শনিবার",
                team1: "ব্রাজিল",
                team2: "হাইতি",
                flag1: "🇧🇷",
                flag2: "🇭🇹",
                group: "গ্রুপ C",
                time: "সকাল ০৭:০০ টা",
                venue: "ফিলাডেলফিয়া"
            },
            {
                id: 11,
                date: "২১ জুন, ২০২৬",
                day: "রবিবার",
                team1: "স্পেন",
                team2: "সৌদি আরব",
                flag1: "🇪🇸",
                flag2: "🇸🇦",
                group: "গ্রুপ H",
                time: "রাত ১০:০০ টা",
                venue: "আটলান্টা"
            },
            {
                id: 12,
                date: "২২ জুন, ২০২৬",
                day: "সোমবার",
                team1: "আর্জেন্টিনা",
                team2: "অস্ট্রিয়া",
                flag1: "🇦🇷",
                flag2: "🇦🇹",
                group: "গ্রুপ J",
                time: "রাত ১১:০০ টা",
                venue: "ডালাস"
            },
            {
                id: 13,
                date: "২৮ জুন, ২০২৬",
                day: "রবিবার",
                team1: "জর্ডান",
                team2: "আর্জেন্টিনা",
                flag1: "🇯🇴",
                flag2: "🇦🇷",
                group: "গ্রুপ J",
                time: "সকাল ০৮:০০ টা",
                venue: "ডালাস"
            },
            {
                id: 14,
                date: "২০ জুলাই, ২০২৬",
                day: "সোমবার",
                team1: "গ্র্যান্ড ফাইনাল",
                team2: "শীর্ষ ২ দল",
                flag1: "🏆",
                flag2: "⚽",
                group: "ফাইনাল",
                time: "রাত ০২:০০ টা (সম্ভাব্য)",
                venue: "নিউ ইয়র্ক / নিউ জার্সি"
            }
        ];

        // ম্যাচগুলো রেন্ডার করার ফাংশন
        function renderMatches(matchesToDisplay) {
            const container = document.getElementById('fixtureContainer');
            container.innerHTML = '';

            if (matchesToDisplay.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-12 text-slate-500 bg-slate-900/20 rounded-2xl border border-dashed border-slate-800">
                        কোনো ম্যাচ পাওয়া যায়নি! অন্য কিছু লিখে সার্চ করুন।
                    </div>
                `;
                return;
            }

            matchesToDisplay.forEach(match => {
                // আর্জেন্টিনা বা ব্রাজিলের জন্য স্পেশাল বর্ডার বা গ্লো ইফেক্ট
                let specialClass = "border-slate-800/60";
                if (match.team1 === "আর্জেন্টিনা" || match.team2 === "আর্জেন্টিনা") specialClass = "border-sky-500/30 bg-sky-500/5";
                if (match.team1 === "ব্রাজিল" || match.team2 === "ব্রাজিল") specialClass = "border-emerald-500/30 bg-emerald-500/5";
                if (match.group === "ফাইনাল") specialClass = "border-amber-500/50 bg-amber-500/10 shadow-lg shadow-amber-500/5";

                const matchCard = `
                    <div class="glass-card rounded-2xl p-4 sm:p-5 flex flex-col md:flex-row items-center justify-between gap-4 border ${specialClass} transition-all hover:scale-[1.01]">
                        <!-- Date & Group Info -->
                        <div class="text-center md:text-left min-w-[160px]">
                            <span class="text-xs font-semibold px-2 py-1 rounded bg-slate-800 text-slate-300">${match.group}</span>
                            <h3 class="font-bold text-amber-400 mt-2 text-base">${match.date}</h3>
                            <p class="text-xs text-slate-400">${match.day}</p>
                        </div>

                        <!-- Teams VS Display -->
                        <div class="flex items-center justify-center gap-4 flex-1 my-2 md:my-0">
                            <div class="flex items-center gap-2 justify-end w-[40%] text-right">
                                <span class="font-semibold text-sm sm:text-base hidden sm:inline">${match.team1}</span>
                                <span class="text-2xl">${match.flag1}</span>
                                <span class="font-semibold text-sm sm:hidden">${match.team1.substring(0,6)}</span>
                            </div>
                            
                            <div class="bg-slate-800 px-3 py-1 rounded-full text-xs font-bold text-slate-400 border border-slate-700/50">VS</div>
                            
                            <div class="flex items-center gap-2 justify-start w-[40%]">
                                <span class="text-2xl">${match.flag2}</span>
                                <span class="font-semibold text-sm sm:text-base hidden sm:inline">${match.team2}</span>
                                <span class="font-semibold text-sm sm:hidden">${match.team2.substring(0,6)}</span>
                            </div>
                        </div>

                        <!-- Time & Venue -->
                        <div class="text-center md:text-right min-w-[160px]">
                            <div class="text-sm font-bold text-emerald-400 flex items-center justify-center md:justify-end gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                ${match.time}
                            </div>
                            <p class="text-xs text-slate-400 mt-1">📍 ${match.venue}</p>
                        </div>
                    </div>
                `;
                container.innerHTML += matchCard;
            });
        }

        // লাইভ সার্চ ফিল্টার
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase();
            const filtered = matches.filter(m =>
                m.team1.toLowerCase().includes(query) ||
                m.team2.toLowerCase().includes(query) ||
                m.group.toLowerCase().includes(query) ||
                m.date.toLowerCase().includes(query)
            );
            renderMatches(filtered);
            resetButtons();
        });

        // কুইক ফিল্টার বাটন ফাংশন
        function filterMatches(team) {
            resetButtons();
            document.getElementById('searchInput').value = '';

            if (team === 'all') {
                document.getElementById('btn-all').className = "px-4 py-2 text-sm font-semibold rounded-xl bg-amber-500 text-slate-950 transition-all cursor-pointer";
                renderMatches(matches);
            } else if (team === 'Argentina') {
                document.getElementById('btn-arg').className = "px-4 py-2 text-sm font-semibold rounded-xl bg-sky-500 text-slate-950 transition-all cursor-pointer";
                const filtered = matches.filter(m => m.team1 === "আর্জেন্টিনা" || m.team2 === "আর্জেন্টিনা");
                renderMatches(filtered);
            } else if (team === 'Brazil') {
                document.getElementById('btn-bra').className = "px-4 py-2 text-sm font-semibold rounded-xl bg-emerald-500 text-slate-950 transition-all cursor-pointer";
                const filtered = matches.filter(m => m.team1 === "ব্রাজিল" || m.team2 === "ব্রাজিল");
                renderMatches(filtered);
            }
        }

        function resetButtons() {
            document.getElementById('btn-all').className = "px-4 py-2 text-sm font-semibold rounded-xl bg-slate-800 hover:bg-slate-700 text-white transition-all cursor-pointer";
            document.getElementById('btn-arg').className = "px-4 py-2 text-sm font-semibold rounded-xl bg-slate-800 hover:bg-slate-700 text-white transition-all cursor-pointer";
            document.getElementById('btn-bra').className = "px-4 py-2 text-sm font-semibold rounded-xl bg-slate-800 hover:bg-slate-700 text-white transition-all cursor-pointer";
        }

        // পেজ লোড হলে প্রথমবার ডাটা দেখাবে
        renderMatches(matches);
    </script>
</body>

</html>