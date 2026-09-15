<?php
// Site configuration
$siteName = 'ফলাফল সেতু';
$siteDescription = 'ফলাফল সেতু বিডি — পরীক্ষার ফলাফল ডিরেক্টরি';
$currentYear = date('Y');
$todayDate = date('d F Y');
$bdTodayDate = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
$todayBn = $bdTodayDate->format('d F Y');

// Include header
require_once __DIR__ . '/includes/header.php';
?>

<main>
  <div class="hero">
    <div class="notice">
      <div class="stamp"><span>শুধুমাত্র অফিসিয়াল উৎসের লিঙ্ক</span></div>
      <div class="notice-ref">
        <span>রেফারেন্স: ফলাফল-ডিরেক্টরি / <?php echo $currentYear; ?></span>
        <span id="today-date">তারিখ: <?php echo $todayBn; ?></span>
      </div>
      <h1>
        <span class="bn">সকল পরীক্ষার ফলাফল, এক জায়গায়।</span>
        বাংলাদেশের প্রতিটি পরীক্ষার ফলাফল, তার অফিসিয়াল উৎসে নির্দেশিত।
      </h1>
      <p class="lede">এই পেজটি নিজে কোনো ফলাফল প্রকাশ করে না — এটি একটি ডিরেক্টরি যা আপনাকে সরাসরি আসল সরকারি, বিশ্ববিদ্যালয় এবং বোর্ড পোর্টালগুলিতে নিয়ে যায় এসএসসি, এইচএসসি, দাখিল, আলিম, ভোকেশনাল, পিএসসি, বিশ্ববিদ্যালয় ভর্তি এবং চাকুরীর পরীক্ষার ফলাফলের জন্য, যাতে আপনাকে কখনও অনুসন্ধান করতে বা নকল সাইটে যেতে না হয়।</p>
      <div class="hero-actions">
        <a class="btn btn-primary" href="https://www.eboardresults.com" target="_blank" rel="noopener">
          এসএসসি / এইচএসসি ফলাফল দেখুন <small>eboardresults.com</small>
        </a>
        <a class="btn btn-ghost" href="https://www.educationboardresults.gov.bd/result" target="_blank" rel="noopener">
          মন্ত্রণালয়ের পোর্টাল <small>educationboardresults.gov.bd/result</small>
        </a>
      </div>
      <div class="disclaimer-bar">
        <p>বেশিরভাগ অফিসিয়াল বাংলাদেশী সরকারি সাইট অন্য ওয়েবসাইটের ফ্রেমে লোড হতে বাধা দেয় (এটি একটি নিরাপত্তা সেটিং যাকে <span class="mono">X-Frame-Options</span> বলা হয়)। নিচে যেখানে "সরাসরি ফলাফল দেখুন" প্যানেলটি দেখছেন, সেটিকে একটি সুবিধাজনক প্রচেষ্টা হিসেবে গণ্য করুন — যদি এটি খালি থাকে, তবে এর পাশের "অফিসিয়াল সাইট খুলুন" বোতামটি ব্যবহার করুন। এর মানে হলো সাইটটি সঠিকভাবে কাজ করছে, শুধু অন্য সাইটে এমবেড হতে দিচ্ছে না।</p>
      </div>
    </div>
  </div>

  <!-- ============ LIVE LOOKUP ============ -->
  <section id="lookup">
    <div class="section-head">
      <span class="section-num">00</span>
      <h2>সরাসরি ফলাফল দেখুন</h2>
    </div>
    <p class="section-desc">এখানে সরাসরি ফলাফল দেখতে আপনার পরীক্ষার নাম, বছর, বোর্ড এবং রোল নম্বর সঠিকভাবে দিন। যদি কোনো ত্রুটি দেখায় বা "ফলাফল পাওয়া যায়নি" বার্তা আসে, তবে অনুগ্রহ করে আপনার দেওয়া তথ্যগুলো আবার যাচাই করুন।</p>
    <form id="live-result-form" class="custom-api-form">
      <div class="form-grid">
        <div class="form-control">
          <label for="live-exam-input" class="sr-only">পরীক্ষা</label>
          <select id="live-exam-input" name="exam" required><option value="">পরীক্ষা</option><option value="ssc">SSC</option><option value="hsc">HSC</option><option value="dakhil">DAKHIL</option><option value="alim">ALIM</option></select>
        </div>
        <div class="form-control">
          <label for="live-year-input" class="sr-only">বছর</label>
          <input id="live-year-input" type="text" inputmode="numeric" pattern="[0-9]{4}" name="year" placeholder="বছর (e.g. 2024)" required>
        </div>
        <div class="form-control">
          <label for="live-board-input" class="sr-only">বোর্ড</label>
          <select id="live-board-input" name="board" required>
            <option value="">বোর্ড</option>
            <option value="dhaka">ঢাকা</option><option value="dinajpur">দিনাজপুর</option><option value="rajshahi">রাজশাহী</option>
            <option value="comilla">কুমিল্লা</option><option value="chittagong">চট্টগ্রাম</option><option value="barisal">বরিশাল</option>
            <option value="sylhet">সিলেট</option><option value="jessore">যশোর</option><option value="mymensingh">ময়মনসিংহ</option>
            <option value="madrasah">মাদ্রাসা</option><option value="tec">কারিগরি</option>
          </select>
        </div>
        <div class="form-control">
          <label for="live-roll-input" class="sr-only">রোল নম্বর</label>
          <input id="live-roll-input" type="text" inputmode="numeric" pattern="[0-9]*" name="roll" placeholder="রোল নম্বর" required>
        </div>
        <div class="form-control">
          <label for="live-reg-input" class="sr-only">রেজিস্ট্রেশন নম্বর</label>
          <input id="live-reg-input" type="text" inputmode="numeric" pattern="[0-9]*" name="reg" placeholder="রেজিস্ট্রেশন নম্বর" required>
        </div>
        <button type="submit" class="btn btn-primary">ফলাফল দেখুন</button>
      </div>
    </form>
    <div id="live-result-display" class="api-result-display" aria-live="polite" aria-atomic="true"></div>
  </section>

  <!-- ============ SECONDARY ============ -->
  <section id="secondary">
    <div class="section-head">
      <span class="section-num">01</span>
      <h2>মাধ্যমিক স্তর (এসএসসি · দাখিল · ভোকেশনাল)</h2>
    </div>
    <p class="section-desc">এসএসসি, দাখিল (মাদ্রাসা সমমান) এবং এসএসসি ভোকেশনাল — দশম শ্রেণির শেষে ১১টি শিক্ষা বোর্ডের অধীনে এই পরীক্ষা অনুষ্ঠিত হয়।</p>
    <div class="grid">
      <div class="card">
        <div class="card-top"><h3>এসএসসি / দাখিল / ভোকেশনাল ফলাফল</h3><span class="badge gov">সরকারি</span></div>
        <p>সকল বোর্ডের জন্য পৃথক, প্রতিষ্ঠান ও জেলাভিত্তিক মার্কশিটসহ ফলাফলের জন্য শিক্ষা মন্ত্রণালয়ের অফিসিয়াল পোর্টাল।</p>
        <div class="card-url">educationboardresults.gov.bd/result</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.educationboardresults.gov.bd/result" target="_blank" rel="noopener">ফলাফল খুঁজুন ↗</a>
        </div>
      </div>
      <div class="card alt">
        <div class="card-top"><h3>ওয়েব ভিত্তিক ফলাফল সিস্টেম</h3><span class="badge">বোর্ড পোর্টাল</span></div>
        <p>ফলাফল প্রকাশের প্ল্যাটফর্ম যেখানে বোর্ডগুলো সরাসরি ফলাফল প্রকাশ করে। এটি প্রতিষ্ঠান ও জেলাভিত্তিক অনুসন্ধান সমর্থন করে এবং ১৯৯৬ সাল পর্যন্ত আর্কাইভ রয়েছে।</p>
        <div class="card-url">eboardresults.com</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.eboardresults.com" target="_blank" rel="noopener">ফলাফল খুঁজুন ↗</a>
        </div>
      </div>
    </div>

    <div class="lookup-panel" style="margin-top:24px;">
      <div class="lookup-tabs">
        <div class="lookup-tab active">eboardresults.com</div>
      </div>
      <div class="lookup-body">
        <div class="lookup-frame-wrap">
          <iframe src="https://www.eboardresults.com" title="eboardresults.com" sandbox="allow-scripts allow-same-origin allow-forms allow-popups"></iframe>
        </div>
        <div class="lookup-fallback">
          <strong>ইফ্রেম লোড হচ্ছে না?</strong>
          <a class="link-btn primary" href="https://www.eboardresults.com" target="_blank" rel="noopener">সরাসরি খুলুন ↗</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ HIGHER SECONDARY ============ -->
  <section id="higher-secondary">
    <div class="section-head">
      <span class="section-num">02</span>
      <h2>উচ্চ মাধ্যমিক স্তর (এইচএসসি · আলিম · ভোকেশনাল)</h2>
    </div>
    <p class="section-desc">এইচএসসি, আলিম (মাদ্রাসা সমমান), এইচএসসি ভোকেশনাল এবং এইচএসসি ব্যবসায় ব্যবস্থাপনা — দ্বাদশ শ্রেণির শেষে এই পরীক্ষা অনুষ্ঠিত হয়।</p>
    <div class="grid">
      <div class="card">
        <div class="card-top"><h3>এইচএসসি / আলিম / ভোকেশনাল ফলাফল</h3><span class="badge gov">সরকারি</span></div>
        <p>এসএসসি-র জন্য ব্যবহৃত একই মন্ত্রণালয়ের পোর্টাল, বোর্ডগুলো ফলাফল প্রকাশ করার পর এখানে এইচএসসি-স্তরের ফলাফলও পাওয়া যায়।</p>
        <div class="card-url">educationboardresults.gov.bd/result</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.educationboardresults.gov.bd/result" target="_blank" rel="noopener">ফলাফল খুঁজুন ↗</a>
        </div>
      </div>
      <div class="card alt">
        <div class="card-top"><h3>ওয়েব ভিত্তিক ফলাফল সিস্টেম</h3><span class="badge">বোর্ড পোর্টাল</span></div>
        <p>উপরের মত একই প্ল্যাটফর্ম; আপনার বোর্ড এবং বছর নির্বাচন করার পরে পরীক্ষার ধরন হিসেবে এইচএসসি/আলিম/এইচএসসি ভোকেশনাল/এইচএসসি বিএম নির্বাচন করুন।</p>
        <div class="card-url">eboardresults.com</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.eboardresults.com" target="_blank" rel="noopener">ফলাফল খুঁজুন ↗</a>
        </div>
      </div>
    </div>

    <div class="lookup-panel" style="margin-top:24px;">
      <div class="lookup-tabs">
        <div class="lookup-tab active">ওয়েব ভিত্তিক ফলাফল সিস্টেম</div>
      </div>
      <div class="lookup-body">
        <div class="lookup-frame-wrap">
          <iframe src="https://www.eboardresults.com" title="ওয়েব ভিত্তিক ফলাফল সিস্টেম" sandbox="allow-scripts allow-same-origin allow-forms allow-popups"></iframe>
        </div>
        <div class="lookup-fallback">
          <strong>ইফ্রেম লোড হচ্ছে না?</strong>
          <a class="link-btn primary" href="https://www.eboardresults.com" target="_blank" rel="noopener">সরাসরি খুলুন ↗</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ PRIMARY ============ -->
  <section id="primary">
    <div class="section-head">
      <span class="section-num">03</span>
      <h2>প্রাথমিক স্তর (পিএসসি · ইবতেদায়ী)</h2>
    </div>
    <p class="section-desc">প্রাথমিক শিক্ষা সমাপনী (পিইসিই/পিএসসি) এবং ইবতেদায়ী পরীক্ষার ফলাফল, যা প্রাথমিক শিক্ষা অধিদপ্তর (ডিপিই) দ্বারা পরিচালিত হয় — এটি উপরের মাধ্যমিক ও উচ্চ মাধ্যমিক বোর্ডগুলো থেকে আলাদা।</p>
    <div class="grid">
      <div class="card">
        <div class="card-top"><h3>প্রাথমিক শিক্ষা অধিদপ্তর</h3><span class="badge gov">সরকারি</span></div>
        <p>ডিপিই-এর অফিসিয়াল সাইট — সাধারণ তথ্য, নোটিশ এবং প্রাথমিক স্তরের পরীক্ষার ফলাফল দেখার পরিষেবার লিঙ্ক।</p>
        <div class="card-url">dpe.gov.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://dpe.gov.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card alt">
        <div class="card-top"><h3>টেলিটকের মাধ্যমে প্রাথমিক ফলাফল</h3><span class="badge">ফলাফল পরিষেবা</span></div>
        <p>প্রাথমিক/ইবতেদায়ী পরীক্ষার জন্য টেলিটক পরিচালিত ফলাফল অনুসন্ধান, যা নিচের এসএমএস পদ্ধতির পাশাপাশি ব্যবহৃত হয়।</p>
        <div class="card-url">dpe.teletalk.com.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://dpe.teletalk.com.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card">
        <div class="card-top"><h3>প্রাথমিক বৃত্তি ফলাফল</h3><span class="badge gov">সরকারি</span></div>
        <p>প্রাথমিক স্তরের বৃত্তির ফলাফলের জন্য অফিসিয়াল পোর্টাল, যা প্রাথমিক শিক্ষা অধিদপ্তর দ্বারা পরিচালিত।</p>
        <div class="card-url">ipemis.dpe.gov.bd/scholarship-results</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://ipemis.dpe.gov.bd/scholarship-results" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
    </div>

    <div class="lookup-panel" style="margin-top:24px;">
      <div class="lookup-tabs">
        <div class="lookup-tab active">টেলিটক প্রাথমিক ফলাফল</div>
      </div>
      <div class="lookup-body">
        <div class="lookup-frame-wrap">
          <iframe src="https://dpe.teletalk.com.bd" title="টেলিটক প্রাথমিক ফলাফল" sandbox="allow-scripts allow-same-origin allow-forms allow-popups"></iframe>
        </div>
        <div class="lookup-fallback">
          <strong>ইফ্রেম লোড হচ্ছে না?</strong>
          <a class="link-btn primary" href="https://dpe.teletalk.com.bd" target="_blank" rel="noopener">সরাসরি খুলুন ↗</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ UNIVERSITY ADMISSION ============ -->
  <section id="university">
    <div class="section-head">
      <span class="section-num">04</span>
      <h2>বিশ্ববিদ্যালয় ভর্তি ফলাফল</h2>
    </div>
    <p class="section-desc">ভর্তি পরীক্ষার ফলাফল প্রতিটি বিশ্ববিদ্যালয় বা গুচ্ছভিত্তিতে প্রকাশিত হয় — কোনো একক জাতীয় পোর্টাল নেই। নিচে সর্বাধিক ব্যবহৃত অফিসিয়াল সিস্টেমগুলো দেওয়া হলো; রোল নম্বর চেক করার আগে সর্বদা নিশ্চিত হয়ে নিন যে আপনি সঠিক ইউনিট/বিশ্ববিদ্যালয়ে আছেন।</p>
    <div class="grid">
      <div class="card">
        <div class="card-top"><h3>জিএসটি ভর্তি (গুচ্ছ)</h3><span class="badge gov">অফিসিয়াল</span></div>
        <p>প্রায় ২০টি পাবলিক বিশ্ববিদ্যালয় (সাধারণ, বিজ্ঞান ও প্রযুক্তি গুচ্ছ) নিয়ে সমন্বিত ভর্তি ব্যবস্থা — প্রতি ইউনিটের জন্য একটি আবেদন, একটি পরীক্ষা, এবং ফলাফল এখানে প্রকাশিত হয়।</p>
        <div class="card-url">gstadmission.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://gstadmission.ac.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card alt">
        <div class="card-top"><h3>জাতীয় বিশ্ববিদ্যালয়</h3><span class="badge">অফিসিয়াল</span></div>
        <p>সারা দেশে জাতীয় বিশ্ববিদ্যালয়ের অধিভুক্ত কলেজগুলির জন্য অনার্স, ডিগ্রি এবং মাস্টার্স পরীক্ষার ফলাফল।</p>
        <div class="card-url">nu.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.nu.ac.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card">
        <div class="card-top"><h3>ঢাকা বিশ্ববিদ্যালয়</h3><span class="badge">অফিসিয়াল</span></div>
        <p>ঢাকা বিশ্ববিদ্যালয় জিএসটি গুচ্ছের বাইরে নিজস্ব ভর্তি পরীক্ষা পরিচালনা করে; ফলাফল এবং বিজ্ঞপ্তি তাদের নিজস্ব সাইটে পোস্ট করা হয়।</p>
        <div class="card-url">du.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.du.ac.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card alt">
        <div class="card-top"><h3>বুয়েট</h3><span class="badge">অফিসিয়াল</span></div>
        <p>বাংলাদেশ প্রকৌশল ও প্রযুক্তি বিশ্ববিদ্যালয় নিজস্ব আলাদা প্রকৌশল ভর্তি পরীক্ষা আয়োজন করে।</p>
        <div class="card-url">buet.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.buet.ac.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
    </div>
    <p class="tag-note" style="margin-top:16px;">মেডিকেল ও ডেন্টাল ভর্তি পরীক্ষার ফলাফল স্বাস্থ্য অধিদপ্তর (DGHS) দ্বারা প্রকাশিত হয়; বর্তমান চক্রের লিঙ্কের জন্য dghs.gov.bd দেখুন, কারণ এটি মাঝে মাঝে সাবডোমেন পরিবর্তন করে।</p>

    <div class="lookup-panel" style="margin-top:24px;">
      <div class="lookup-tabs">
        <div class="lookup-tab active">জিএসটি ভর্তি ফলাফল</div>
      </div>
      <div class="lookup-body">
        <div class="lookup-frame-wrap">
          <iframe src="https://gstadmission.ac.bd" title="জিএসটি ভর্তি ফলাফল" sandbox="allow-scripts allow-same-origin allow-forms allow-popups"></iframe>
        </div>
        <div class="lookup-fallback">
          <strong>ইফ্রেম লোড হচ্ছে না?</strong>
          <a class="link-btn primary" href="https://gstadmission.ac.bd" target="_blank" rel="noopener">সরাসরি খুলুন ↗</a>
        </div>
      </div>
    </div>

    <div style="margin-top:18px; padding:18px; background:var(--white); border:1px solid var(--rule);">
      <h3 style="margin:0 0 10px; font-size:17px; color:var(--green-deep);">জাতীয় বিশ্ববিদ্যালয় ফলাফল</h3>
      <p style="margin:0 0 12px; font-size:13.5px; color:var(--ink-soft);">জাতীয় বিশ্ববিদ্যালয়ের অনার্স, ডিগ্রি এবং মাস্টার্স পরীক্ষার ফলাফল সরাসরি দেখুন:</p>
      <a class="link-btn primary" href="https://results.nu.ac.bd/" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
    </div>
  </section>

  <!-- ============ JOB EXAMS ============ -->
  <section id="job-exams">
    <div class="section-head">
      <span class="section-num">05</span>
      <h2>চাকুরী পরীক্ষার ফলাফল</h2>
    </div>
    <p class="section-desc">বাংলাদেশের সরকারি, স্বায়ত্তশাসিত ও বাণিজ্যিক প্রতিষ্ঠানগুলোর চাকুরী পরীক্ষার ফলাফল ও বিজ্ঞপ্তির অফিসিয়াল উৎসসমূহ।</p>
    <div class="grid">
      <div class="card">
        <div class="card-top"><h3>বিসিএস পূর্ণকালীন চাকুরী পরীক্ষা</h3><span class="badge gov">সরকারি</span></div>
        <p>বিসিএস কেন্দ্রীয় ও লিখিত পরীক্ষার ফলাফল, প্রকাশের বিজ্ঞপ্তি এবং পুনঃনিরীক্ষণের জন্য সরকারের অফিসিয়াল পোর্টাল।</p>
        <div class="card-url">bpsc.gov.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://bpsc.gov.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card alt">
        <div class="card-top"><h3>ব্যাংক জব ও গণপূর্ত চাকুরী</h3><span class="badge">বোর্ড পোর্টাল</span></div>
        <p>বাংলাদেশ ব্যাংক, Sonar Bangla, ICB, Sonali Bank, Janata Bank, Agrani Bank, Rupali Bank, Bangladesh Krishi Bank, BKash, Nagad ও বড় সрьাচালিত ব্যাংক ও আর্থিক প্রতিষ্ঠানের চাকুরী পরীক্ষার ফলাফল।</p>
        <div class="card-url">bb.org.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.bb.org.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card">
        <div class="card-top"><h3>বাংলাদেশ ব্যাংক চাকুরী পরীক্ষা</h3><span class="badge gov">সরকারি</span></div>
        <p>বাংলাদেশ ব্যাংক-এর বিভিন্ন পদের চাকুরী পরীক্ষার ফলাফল ও বিজ্ঞপ্তি, যা bangladeshbank.org.bd-এ প্রকাশিত হয়।</p>
        <div class="card-url">bangladeshbank.org.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.bangladeshbank.org.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card alt">
        <div class="card-top"><h3>বিএনটি চাকুরী পরীক্ষা</h3><span class="badge">সরকারি</span></div>
        <p>বাংলাদেশ টেলিভিজন (বিটিভি), বাংলাদেশ betar ও অন্যান্য সরকারি মিডিয়া প্রতিষ্ঠানের চাকুরী পরীক্ষার ফলাফল।</p>
        <div class="card-url">btv.gov.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://btv.gov.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card">
        <div class="card-top"><h3>সশস্ত্র বাহিনী ও পুলিশ চাকুরী</h3><span class="badge gov">সরকারি</span></div>
        <p>বাংলাদেশ সশস্ত্র বাহিনী, বাংলাদেশ পুলিশ, র‍্যাব, বিআরটিবি ও সশস্ত্র শেখ হাসিনা ক্যান্টনমেন্ট কলেজ-এর চাকুরী পরীক্ষার ফলাফল ও বিজ্ঞপ্তি।</p>
        <div class="card-url">army.mil.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://army.mil.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card alt">
        <div class="card-top"><h3>অন্যান্য চাকুরী পরীক্ষা</h3><span class="badge">বর্ণনা</span></div>
        <p>বিএইউট, বিউটেক্স, জাতীয় বিশ্ববিদ্যালয়, বাংলাদেশ বিশ্ববিদ্যালয় ও অন্যান্য সরকারি ও বেসরকারি প্রতিষ্ঠানের চাকুরী পরীক্ষার ফলাফল ও বিজ্ঞপ্তি।</p>
        <div class="card-url">nu.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.nu.ac.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
    </div>

    <div class="lookup-panel" style="margin-top:24px;">
      <div class="lookup-tabs">
        <div class="lookup-tab active">বিসিএস চাকুরী ফলাফল</div>
      </div>
      <div class="lookup-body">
        <div class="lookup-frame-wrap">
          <iframe src="https://bpsc.gov.bd" title="বিসিএস চাকুরী ফলাফল" sandbox="allow-scripts allow-same-origin allow-forms allow-popups"></iframe>
        </div>
        <div class="lookup-fallback">
          <strong>ইফ্রেম লোড হচ্ছে না?</strong>
          <a class="link-btn primary" href="https://bpsc.gov.bd" target="_blank" rel="noopener">সরাসরি খুলুন ↗</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ BOARDS ============ -->
  <section id="boards">
    <div class="section-head">
      <span class="section-num">06</span>
      <h2>১১টি শিক্ষা বোর্ড</h2>
    </div>
    <p class="section-desc">প্রতিটি বোর্ড উপরের শেয়ার করা পোর্টালগুলির মাধ্যমে ফলাফল প্রকাশ করে। কয়েকটি বোর্ড নোটিশ, পুনঃনিরীক্ষণের ফর্ম এবং পুরোনো আর্কাইভের জন্য তাদের নিজস্ব বোর্ড-নির্দিষ্ট সাইটও পরিচালনা করে।</p>
    <table class="board-table">
      <thead>
        <tr><th>বোর্ড</th><th>ধরন</th><th>সরাসরি সাইট</th></tr>
      </thead>
      <tbody>
        <tr><td>ঢাকা</td><td>সাধারণ</td><td><a href="https://www.dhakaeducationboard.gov.bd" target="_blank" rel="noopener">dhakaeducationboard.gov.bd</a></td></tr>
        <tr><td>যশোর</td><td>সাধারণ</td><td><a href="https://www.jessoreboard.gov.bd" target="_blank" rel="noopener">jessoreboard.gov.bd</a></td></tr>
        <tr><td>চট্টগ্রাম, কুমিল্লা, রাজশাহী, বরিশাল, দিনাজপুর, সিলেট, ময়মনসিংহ</td><td>সাধারণ</td><td class="tag-note">ফলাফল educationboardresults.gov.bd / eboardresults.com এর মাধ্যমে প্রকাশিত হয় — বোর্ডের নিজস্ব নোটিশ সাইটের জন্য "[বোর্ডের নাম] education board gov bd" লিখে অনুসন্ধান করুন।</td></tr>
        <tr><td>বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড</td><td>দাখিল / আলিম</td><td class="tag-note">ফলাফল educationboardresults.gov.bd-এ সমন্বিত</td></tr>
        <tr><td>বাংলাদেশ কারিগরি শিক্ষা বোর্ড</td><td>ভোকেশনাল / ডিপ্লোমা</td><td class="tag-note">ফলাফল educationboardresults.gov.bd-এ সমন্বিত</td></tr>
      </tbody>
    </table>
  </section>

  <!-- ============ SMS ============ -->
  <section id="sms">
    <div class="section-head">
      <span class="section-num">07</span>
      <h2>ইন্টারনেট নেই? এসএমএস ব্যবহার করুন</h2>
    </div>
    <div class="sms-box">
      <div>
        <h3>এসএসসি / এইচএসসি ও সমমান</h3>
        <p>ফরম্যাট: <span class="mono">BOARD-FIRST-3-LETTERS ROLL YEAR</span>, পাঠান <strong>16222</strong> নম্বরে।</p>
        <div class="sms-example">SSC DHA 123456 2026<br>send to 16222</div>
        <p style="margin-top:10px;">প্রয়োজন অনুযায়ী <span class="mono">SSC</span>-এর পরিবর্তে <span class="mono">HSC</span>, <span class="mono">DAKHIL</span> বা <span class="mono">ALIM</span> লিখুন, এবং আপনার বোর্ডের কোড ব্যবহার করুন (যেমন DHA, CHI, RAJ, JES, COM, BAR, SYL, DIN, MYM, MAD, TEC)।</p>
      </div>
      <div>
        <h3>প্রাথমিক (পিএসসি / ইবতেদায়ী)</h3>
        <p>ফরম্যাট: <span class="mono">DPE ROLL YEAR</span>, পাঠান <strong>16222</strong> নম্বরে।</p>
        <div class="sms-example">DPE 123456 2026<br>send to 16222</div>
        <p style="margin-top:10px;">এসএমএস-এর মাধ্যমে দ্রুত পাশ/ফেল এবং জিপিএ জানা যায়; ওয়েবসাইটে বিষয়ভিত্তিক সম্পূর্ণ মার্কশিট পাওয়া যায়।</p>
      </div>
    </div>
  </section>

  <!-- ============ CUSTOM API EXAMPLE ============ -->
  <section id="custom-api">
    <div class="section-head">
      <span class="section-num">08</span>
      <h2>কাস্টম API ব্যবহার করে ফলাফল</h2>
    </div>
    <p class="section-desc">এটি একটি উদাহরণ যা দেখায় কিভাবে একটি কাস্টম API (যেমন EduBoardAPI) ব্যবহার করে ফলাফল আনা যায়। এটি আপনাকে ফলাফলের প্রদর্শন সম্পূর্ণরূপে নিয়ন্ত্রণ করার সুযোগ দেয়।</p>
    <form id="custom-result-form" class="custom-api-form">
      <div class="form-grid">
        <div class="form-control">
          <label for="exam-input" class="sr-only">পরীক্ষা</label>
          <select id="exam-input" name="exam" required><option value="">পরীক্ষা</option><option value="ssc">SSC</option><option value="hsc">HSC</option></select>
        </div>
        <div class="form-control">
          <label for="year-input" class="sr-only">বছর</label>
          <input id="year-input" type="text" inputmode="numeric" pattern="[0-9]{4}" name="year" placeholder="বছর (e.g., 2024)" required>
        </div>
        <div class="form-control">
          <label for="board-input" class="sr-only">বোর্ড</label>
          <select id="board-input" name="board" required>
            <option value="">বোর্ড</option>
            <option value="dhaka">Dhaka</option><option value="dinajpur">Dinajpur</option><option value="rajshahi">Rajshahi</option>
            <option value="comilla">Comilla</option><option value="chittagong">Chittagong</option><option value="barisal">Barisal</option>
            <option value="sylhet">Sylhet</option><option value="jessore">Jessore</option><option value="mymensingh">Mymensingh</option>
            <option value="madrasah">Madrasah</option><option value="tec">Technical</option>
          </select>
        </div>
        <div class="form-control">
          <label for="roll-input" class="sr-only">রোল নম্বর</label>
          <input id="roll-input" type="text" inputmode="numeric" pattern="[0-9]*" name="roll" placeholder="রোল নম্বর" required>
        </div>
        <div class="form-control">
          <label for="reg-input" class="sr-only">রেজিস্ট্রেশন নম্বর</label>
          <input id="reg-input" type="text" inputmode="numeric" pattern="[0-9]*" name="reg" placeholder="রেজিস্ট্রেশন নম্বর" required>
        </div>
        <div class="form-control captcha-control">
          <label for="captcha-input" id="captcha-label">নিরাপত্তা প্রশ্ন</label>
          <input id="captcha-input" type="text" inputmode="numeric" name="captcha" placeholder="উত্তর" required autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary">ফলাফল দেখুন</button>
      </div>
    </form>
    <div id="custom-result-display" class="api-result-display" aria-live="polite" aria-atomic="true">
      <!-- API results will be rendered here -->
    </div>
  </section>

  <!-- ============ FAQ ============ -->
  <section id="faq">
    <div class="section-head">
      <span class="section-num">09</span>
      <h2>প্রশ্ন ও উত্তর</h2>
    </div>
    <div class="faq-list">
      <details class="faq-item">
        <summary class="faq-question">এসএসসি ফলাফল কিভাবে দেখব?</summary>
        <div class="faq-answer">
          <p>এসএসসি ফলাফল দেখতে <a href="https://www.educationboardresults.gov.bd/result" target="_blank" rel="noopener">educationboardresults.gov.bd/result</a> অথবা <a href="https://www.eboardresults.com" target="_blank" rel="noopener">eboardresults.com</a>-এ যান। আপনার বোর্ড, রোল নম্বর এবং রেজিস্ট্রেশন নম্বর দিন।</p>
        </div>
      </details>
      <details class="faq-item">
        <summary class="faq-question">এইচএসসি ফলাফল কখন প্রকাশিত হবে?</summary>
        <div class="faq-answer">
          <p>এইচএসসি ফলাফল সাধারণত আগস্টে প্রকাশিত হয়। শিক্ষা মন্ত্রণালয়ের অফিসিয়াল পোর্টাল <a href="https://www.educationboardresults.gov.bd/result" target="_blank" rel="noopener">educationboardresults.gov.bd/result</a>-এ ফলাফল প্রকাশিত হয়।</p>
        </div>
      </details>
      <details class="faq-item">
        <summary class="faq-question">বিসিএস চাকুরী ফলাফল কোথায় পাওয়া যায়?</summary>
        <div class="faq-answer">
          <p>বিসিএস চাকুরী ফলাফল <a href="https://bpsc.gov.bd" target="_blank" rel="noopener">bpsc.gov.bd</a>-এ প্রকাশিত হয়। সাইটে যান এবং লImperatETRIX নম্বর দিয়ে ফলাফল দেখুন।</p>
        </div>
      </details>
      <details class="faq-item">
        <summary class="faq-question">জাতীয় বিশ্ববিদ্যালয় ফলাফল কোথায় দখল করা যায়?</summary>
        <div class="faq-answer">
          <p>জাতীয় বিশ্ববিদ্যালয়ের অনার্স, ডিগ্রি এবং মাস্টার্স পরীক্ষার ফলাফল <a href="https://results.nu.ac.bd/" target="_blank" rel="noopener">results.nu.ac.bd</a>-এ পাওয়া যায়।</p>
        </div>
      </details>
      <details class="faq-item">
        <summary class="faq-question">এসএমএস দিয়ে ফলাফল কিভাবে পাব?</summary>
        <div class="faq-answer">
          <p>এসএসসি/এইচএসসি: <strong>BOARD ROLL YEAR</strong> লিখে <strong>16222</strong> নম্বরে পাঠান। প্রাথমিক: <strong>DPE ROLL YEAR</strong> লিখে <strong>16222</strong> নম্বরে পাঠান।</p>
        </div>
      </details>
      <details class="faq-item">
        <summary class="faq-question">এই সাইটটি সরকারি সাইট কিনা?</summary>
        <div class="faq-answer">
          <p>না, এটি একটি অনানুষ্ঠানিক ডিরেক্টরি। এটি শিক্ষা মন্ত্রণালয়, কোনো শিক্ষা বোর্ড, বা বাংলাদেশ সরকার দ্বারা পরিচালিত নয়। এটি আপনাকে অফিসিয়াল সাইটে সরাসরি লিঙ্ক করে।</p>
        </div>
      </details>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
