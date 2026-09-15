<?php
// Site configuration
$siteName = 'ফলাফল সেতু';
$siteDescription = 'ফলাফল সেতু বিডি — বাংলাদেশের সকল পরীক্ষার ফলাফল ডিরেক্টরি';
$currentYear = date('Y');
$bdTodayDate = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
$todayBn = $bdTodayDate->format('d F Y');

// Include header
require_once __DIR__ . '/includes/header.php';
?>

<main>
  <!-- ============ HERO & SEARCH ENGINE ============ -->
  <div class="hero">
    <div class="notice">
      <div class="stamp"><span>১০০% অফিসিয়াল উৎস</span></div>
      <div class="notice-ref">
        <span>রেফারেন্স: অল-ইন-ওয়ান ফলাফল ডিরেক্টরি / <?php echo $currentYear; ?></span>
        <span id="today-date">তারিখ: <?php echo $todayBn; ?></span>
      </div>
      <h1>
        <span class="bn">বাংলাদেশের সকল পরীক্ষার ফলাফল, এক জায়গায়।</span>
        বোর্ড পরীক্ষা, বিশ্ববিদ্যালয় ভর্তি, মেডিকেল, এনইউ, ডিপ্লোমা ও চাকুরী পরীক্ষার সার্চ ইঞ্জিন
      </h1>
      <p class="lede">বাংলাদেশের এসএসসি, এইচএসসি, দাখিল, আলিম, পিএসসি, গুচ্ছ ভর্তি, ঢাবি, বুয়েট, মেডিকেল, নার্সিং, জাতীয় বিশ্ববিদ্যালয়, ডিপ্লোমা, বিসিএস, এনটিআরসিএ, ব্যাংক ও সকল সরকারি চাকুরীর ফলাফলের অফিসিয়াল লিংক অনুসন্ধান করুন।</p>

      <!-- Instant Live Exam Search Engine -->
      <div id="search-section" class="hero-search-box">
        <div class="search-input-group">
          <span class="search-icon-symbol">🔍</span>
          <input type="text" id="global-exam-search" placeholder="যেকোনো পরীক্ষার নাম বা কিওয়ার্ড লিখুন (e.g. SSC, HSC, Medical, NU, BCS, NTRCA, Primary)..." autocomplete="off" aria-label="পরীক্ষার ফলাফল অনুসন্ধান করুন">
          <button type="button" id="clear-search-btn" class="clear-search-btn" title="মুছে ফেলুন">&times;</button>
        </div>
        <div class="quick-filter-chips">
          <button type="button" class="chip active" data-filter="all">সব ফলাফল</button>
          <button type="button" class="chip" data-filter="board">বোর্ড (SSC/HSC)</button>
          <button type="button" class="chip" data-filter="primary">প্রাথমিক (PEC)</button>
          <button type="button" class="chip" data-filter="university">বিশ্ববিদ্যালয় ভর্তি</button>
          <button type="button" class="chip" data-filter="medical">মেডিকেল ও নার্সিং</button>
          <button type="button" class="chip" data-filter="nu-bteb">জাতীয় ও কারিগরি (NU/BTEB)</button>
          <button type="button" class="chip" data-filter="job">চাকুরী (BCS/Bank/NTRCA)</button>
          <button type="button" class="chip" data-filter="sms">এসএমএস পদ্ধতি</button>
        </div>
        <div class="search-status-bar">
          <span id="search-result-count"></span>
          <small>পরামর্শ: যেকোনো পরীক্ষার নাম বাংলায় বা ইংরেজিতে লিখুন</small>
        </div>
      </div>

      <div class="hero-actions">
        <a class="btn btn-primary" href="https://www.eboardresults.com" target="_blank" rel="noopener">
          এসএসসি / এইচএসসি মার্কশিট <small>eboardresults.com</small>
        </a>
        <a class="btn btn-ghost" href="https://www.educationboardresults.gov.bd/result" target="_blank" rel="noopener">
          শিক্ষা বোর্ড পোর্টাল <small>educationboardresults.gov.bd</small>
        </a>
      </div>
      <div class="disclaimer-bar">
        <p>নিরাপত্তা নীতি (X-Frame-Options)-এর কারণে কিছু অফিসিয়াল সরকারি ওয়েবসাইট সরাসরি অন্য সাইটের ফ্রেমে লোড হতে পারে না। কোনো ফ্রেম খালি দেখালে তার পাশের <strong>"সরাসরি খুলুন ↗"</strong> বাটনটি ব্যবহার করে মূল সরকারি পোর্টালে যান।</p>
      </div>
    </div>
  </div>

  <!-- Search No Match Fallback -->
  <div id="no-results-msg" class="no-results-msg">
    <h3>কোনো পরীক্ষার ফলাফল মেলেনি</h3>
    <p>আপনার অনুসন্ধানের সাথে সংগতিপূর্ণ কোনো ফলাফল পাওয়া যায়নি। শব্দটির বানান পরীক্ষা করুন বা ফিল্টার পরিবর্তন করুন।</p>
    <button type="button" id="reset-search-btn" class="btn btn-ghost">সকল ফলাফল পুনরায় দেখান</button>
  </div>

  <!-- ============ LIVE LOOKUP WIDGET ============ -->
  <section id="lookup">
    <div class="section-head">
      <span class="section-num">00</span>
      <h2>সরাসরি শিক্ষা বোর্ড ফলাফল অনুসন্ধান</h2>
    </div>
    <p class="section-desc">আপনার রোল ও রেজিস্ট্রেশন নম্বর ব্যবহার করে সরাসরি এসএসসি, এইচএসসি, দাখিল ও আলিম পরীক্ষার ফলাফল দেখুন।</p>
    <form id="live-result-form" class="custom-api-form">
      <div class="form-grid">
        <div class="form-control">
          <label for="live-exam-input" class="sr-only">পরীক্ষা</label>
          <select id="live-exam-input" name="exam" required>
            <option value="">পরীক্ষার নাম নির্বাচন করুন</option>
            <option value="ssc">SSC / দাখিল / ভোকেশনাল</option>
            <option value="hsc">HSC / আলিম / ভোকেশনাল</option>
            <option value="dakhil">Dakhil (মাদ্রাসা)</option>
            <option value="alim">Alim (মাদ্রাসা)</option>
          </select>
        </div>
        <div class="form-control">
          <label for="live-year-input" class="sr-only">বছর</label>
          <input id="live-year-input" type="text" inputmode="numeric" pattern="[0-9]{4}" name="year" placeholder="বছর (e.g. 2024)" required>
        </div>
        <div class="form-control">
          <label for="live-board-input" class="sr-only">বোর্ড</label>
          <select id="live-board-input" name="board" required>
            <option value="">শিক্ষা বোর্ড নির্বাচন করুন</option>
            <option value="dhaka">ঢাকা (Dhaka)</option>
            <option value="dinajpur">দিনাজপুর (Dinajpur)</option>
            <option value="rajshahi">রাজশাহী (Rajshahi)</option>
            <option value="comilla">কুমিল্লা (Comilla)</option>
            <option value="chittagong">চট্টগ্রাম (Chittagong)</option>
            <option value="barisal">বরিশাল (Barisal)</option>
            <option value="sylhet">সিলেট (Sylhet)</option>
            <option value="jessore">যশোর (Jessore)</option>
            <option value="mymensingh">ময়মনসিংহ (Mymensingh)</option>
            <option value="madrasah">মাদ্রাসা বোর্ড (Madrasah)</option>
            <option value="tec">কারিগরি বোর্ড (Technical)</option>
          </select>
        </div>
        <div class="form-control">
          <label for="live-roll-input" class="sr-only">রোল নম্বর</label>
          <input id="live-roll-input" type="text" inputmode="numeric" pattern="[0-9]*" name="roll" placeholder="রোল নম্বর (Roll No)" required>
        </div>
        <div class="form-control">
          <label for="live-reg-input" class="sr-only">রেজিস্ট্রেশন নম্বর</label>
          <input id="live-reg-input" type="text" inputmode="numeric" pattern="[0-9]*" name="reg" placeholder="রেজিস্ট্রেশন নম্বর (Reg No)" required>
        </div>
        <button type="submit" class="btn btn-primary">ফলাফল দেখুন</button>
      </div>
    </form>
    <div id="live-result-display" class="api-result-display" aria-live="polite" aria-atomic="true"></div>
  </section>

  <!-- ============ 01: SECONDARY (SSC / DAKHIL / VOCATIONAL) ============ -->
  <section id="secondary">
    <div class="section-head">
      <span class="section-num">01</span>
      <h2>মাধ্যমিক স্তর (এসএসসি · দাখিল · ভোকেশনাল)</h2>
    </div>
    <p class="section-desc">দশম শ্রেণি সমাপনী এসএসসি (SSC), দাখিল (Dakhil - মাদ্রাসা) এবং এসএসসি ভোকেশনাল (Vocational) পরীক্ষার অফিসিয়াল ফলাফল পোর্টাল।</p>
    <div class="grid">
      <div class="card" data-category="board" data-keywords="ssc dakhil vocational board result শিক্ষা বোর্ড ফলাফল">
        <div class="card-top"><h3>এসএসসি / দাখিল / ভোকেশনাল ফলাফল</h3><span class="badge gov">সরকারি পোর্টাল</span></div>
        <p>শিক্ষা মন্ত্রণালয় পরিচালিত মূল অফিসিয়াল রেজাল্ট সিস্টেম। গ্রেড শিট ও মোট নম্বরসহ ব্যক্তিগত ফলাফল দেখার পোর্টাল।</p>
        <div class="card-url">educationboardresults.gov.bd/result</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.educationboardresults.gov.bd/result" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card alt" data-category="board" data-keywords="eboardresults web based ssc mark sheet ইবোর্ড রেজাল্ট প্রতিষ্ঠান ভিত্তিক">
        <div class="card-top"><h3>ওয়েব ভিত্তিক ফলাফল সিস্টেম</h3><span class="badge">বোর্ড ডিরেক্ট</span></div>
        <p>প্রতিষ্ঠানভিত্তিক, জেলাভিত্তিক এবং ব্যক্তিগত ফুল মার্কশিট অনুসন্ধান প্ল্যাটফর্ম (১৯৯৬ সাল থেকে ফলাফল আর্কাইভ সহ)।</p>
        <div class="card-url">eboardresults.com</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.eboardresults.com" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
    </div>

    <div class="lookup-panel" style="margin-top:24px;">
      <div class="lookup-tabs">
        <div class="lookup-tab active">eboardresults.com সরাসরি ভিউ</div>
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

  <!-- ============ 02: HIGHER SECONDARY (HSC / ALIM / VOCATIONAL / BM) ============ -->
  <section id="higher-secondary">
    <div class="section-head">
      <span class="section-num">02</span>
      <h2>উচ্চ মাধ্যমিক স্তর (এইচএসসি · আলিম · বিএম · ভোকেশনাল)</h2>
    </div>
    <p class="section-desc">দ্বাদশ শ্রেণি সমাপনী এইচএসসি (HSC), আলিম (Alim - মাদ্রাসা), এইচএসসি ব্যবসায় ব্যবস্থাপনা (BM) এবং এইচএসসি ভোকেশনাল ফলাফল।</p>
    <div class="grid">
      <div class="card" data-category="board" data-keywords="hsc alim bm vocational higher secondary এইচএসসি আলিম ফলাফল">
        <div class="card-top"><h3>এইচএসসি / আলিম / বিএম ফলাফল</h3><span class="badge gov">সরকারি পোর্টাল</span></div>
        <p>সাধারণ ৯টি বোর্ড, মাদ্রাসা বোর্ড ও কারিগরি শিক্ষা বোর্ডের এইচএসসি এবং আলিম পরীক্ষার ফলাফলের জন্য অফিসিয়াল সাইট।</p>
        <div class="card-url">educationboardresults.gov.bd/result</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.educationboardresults.gov.bd/result" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card alt" data-category="board" data-keywords="eboardresults hsc mark sheet এইচএসসি মার্কশিট">
        <div class="card-top"><h3>ওয়েব ভিত্তিক এইচএসসি মার্কশিট</h3><span class="badge">বোর্ড ডিরেক্ট</span></div>
        <p>এইচএসসি, আলিম এবং ভোকেশনাল পরীক্ষার বিষয়ভিত্তিক বিস্তারিত নম্বরপত্র এবং ইনস্টিটিউট রেজাল্ট শিট ডাউনলোড করুন।</p>
        <div class="card-url">eboardresults.com</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://www.eboardresults.com" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ 03: PRIMARY (PEC / EBTEDAYEE / SCHOLARSHIP) ============ -->
  <section id="primary">
    <div class="section-head">
      <span class="section-num">03</span>
      <h2>প্রাথমিক ও ইবতেদায়ী সমাপনী (পিএসসি · ইবতেদায়ী · বৃত্তি)</h2>
    </div>
    <p class="section-desc">প্রাথমিক শিক্ষা অধিদপ্তর (DPE) পরিচালিত পঞ্চম শ্রেণির প্রাথমিক শিক্ষা সমাপনী (PECE/PSC), ইবতেদায়ী এবং প্রাথমিক মেধা বৃত্তি পরীক্ষার ফলাফল।</p>
    <div class="grid">
      <div class="card" data-category="primary" data-keywords="primary psc pece dpe teletalk প্রাথমিক ফলাফল">
        <div class="card-top"><h3>টেলিটক প্রাথমিক ফলাফল পোর্টাল</h3><span class="badge primary">ডিপিই পোর্টাল</span></div>
        <p>প্রাথমিক শিক্ষা অধিদপ্তরের অফিসিয়াল টেলিকম পার্টনার টেলিটক সার্ভার থেকে পিএসসি ও ইবতেদায়ী ফলাফল অনুসন্ধান।</p>
        <div class="card-url">dpe.teletalk.com.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://dpe.teletalk.com.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card alt" data-category="primary" data-keywords="primary scholarship ipemis dpe প্রাথমিক বৃত্তি ফলাফল">
        <div class="card-top"><h3>প্রাথমিক মেধা বৃত্তি ফলাফল (IPEMIS)</h3><span class="badge gov">সরকারি পোর্টাল</span></div>
        <p>প্রাথমিক শিক্ষা অধিদপ্তরের সমন্বিত শিক্ষা তথ্য ব্যবস্থাপনা (IPEMIS) সাইট থেকে জেলা ও থানা ভিত্তিক বৃত্তি ফলাফল।</p>
        <div class="card-url">ipemis.dpe.gov.bd/scholarship-results</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://ipemis.dpe.gov.bd/scholarship-results" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
      <div class="card" data-category="primary" data-keywords="dpe gov bd primary education result ডিপিই নোটিশ">
        <div class="card-top"><h3>প্রাথমিক শিক্ষা অধিদপ্তর (DPE)</h3><span class="badge gov">অফিসিয়াল</span></div>
        <p>ডিপিই-এর মূল ওয়েবসাইট — প্রাথমিক ফলাফল সংক্রান্ত কেন্দ্রীয় নোটিশ ও গেজেট ডাউনলোডের মাধ্যম।</p>
        <div class="card-url">dpe.gov.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://dpe.gov.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ 04: UNIVERSITY ADMISSIONS ============ -->
  <section id="university">
    <div class="section-head">
      <span class="section-num">04</span>
      <h2>বিশ্ববিদ্যালয় ভর্তি পরীক্ষা (গুচ্ছ, ঢাবি, বুয়েট, সিকেআরইউইটি, রাবি, চবি, জাবি)</h2>
    </div>
    <p class="section-desc">বাংলাদেশের সকল সরকারি ও পাবলিক বিশ্ববিদ্যালয়ের ১ম বর্ষ স্নাতক/অনার্স ভর্তি পরীক্ষার ফলাফল।</p>
    <div class="grid">
      <div class="card" data-category="university" data-keywords="gst admission general science technology গুচ্ছ ভর্তি ফলাফল">
        <div class="card-top"><h3>জিএসটি সাধারণ ও বিজ্ঞান গুচ্ছ ভর্তি</h3><span class="badge admission">গুচ্ছ ভর্তি</span></div>
        <p>২৪টি পাবলিক সাধারণ, বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়ের সমন্বিত জিএসটি (GST) ভর্তি পরীক্ষার ফলাফল ও মেরিট লিস্ট।</p>
        <div class="card-url">gstadmission.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://gstadmission.ac.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card alt" data-category="university" data-keywords="agri gst agricultural university কৃষি গুচ্ছ ভর্তি ফলাফল">
        <div class="card-top"><h3>কৃষি গুচ্ছ ভর্তি পরীক্ষা (Agri GST)</h3><span class="badge admission">কৃষি গুচ্ছ</span></div>
        <p>বাংলাদেশ কৃষি বিশ্ববিদ্যালয় সহ ৯টি সরকারি কৃষি বিশ্ববিদ্যালয়ের সমন্বিত ভর্তি পরীক্ষার ফলাফল ও সাবজেক্ট চয়েস।</p>
        <div class="card-url">agri-gst.org</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://agri-gst.org" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card" data-category="university" data-keywords="dhaka university du admission result ঢাকা বিশ্ববিদ্যালয় ভর্তি">
        <div class="card-top"><h3>ঢাকা বিশ্ববিদ্যালয় (DU)</h3><span class="badge admission">ঢাবি পোর্টাল</span></div>
        <p>ঢাবি বিজ্ঞান (ক), কলা ও সামাজিক বিজ্ঞান (খ), ব্যবসায় শিক্ষা (গ) এবং চারুকলা ইউনিটের ভর্তি পরীক্ষার রেজাল্ট।</p>
        <div class="card-url">admission.eis.du.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://admission.eis.du.ac.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card alt" data-category="university" data-keywords="buet engineering admission result বুয়েট ভর্তি">
        <div class="card-top"><h3>বুয়েট প্রকৌশল ভর্তি (BUET)</h3><span class="badge admission">বুয়েট</span></div>
        <p>বাংলাদেশ প্রকৌশল বিশ্ববিদ্যালয় (BUET)-এর প্রাক-নির্বাচনী ও মূল প্রকৌশল ভর্তি পরীক্ষার ফলাফল ও শর্টলিস্ট।</p>
        <div class="card-url">ugadmission.buet.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://ugadmission.buet.ac.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card" data-category="university" data-keywords="ckruet ruet kuet cuet engineering cluster প্রকৌশল গুচ্ছ">
        <div class="card-top"><h3>প্রকৌশল গুচ্ছ (CKRUET: রুয়েট, কুয়েট, চুয়েট)</h3><span class="badge admission">প্রকৌশল গুচ্ছ</span></div>
        <p>রুয়েট, কুয়েট ও চুয়েট সমন্বিত ইঞ্জিনিয়ারিং ভর্তি পরীক্ষার মেধা তালিকা ও ওয়েটিং লিস্টের ফলাফল।</p>
        <div class="card-url">ckruet.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://ckruet.ac.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card alt" data-category="university" data-keywords="rajshahi university ru admission result রাজশাহী বিশ্ববিদ্যালয়">
        <div class="card-top"><h3>রাজশাহী বিশ্ববিদ্যালয় (RU)</h3><span class="badge admission">রাবি পোর্টাল</span></div>
        <p>রাজশাহী বিশ্ববিদ্যালয়ের ‘এ’, ‘বি’ ও ‘সি’ ইউনিটের ভর্তি পরীক্ষার ফলাফল ও সাক্ষাৎকার নোটিশ।</p>
        <div class="card-url">admission.ru.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://admission.ru.ac.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card" data-category="university" data-keywords="chittagong university cu admission result চট্টগ্রাম বিশ্ববিদ্যালয়">
        <div class="card-top"><h3>চট্টগ্রাম বিশ্ববিদ্যালয় (CU)</h3><span class="badge admission">চবি পোর্টাল</span></div>
        <p>চট্টগ্রাম বিশ্ববিদ্যালয়ের সকল ইউনিট ও উপ-ইউনিটের ভর্তি পরীক্ষার ফলাফল এবং আসন বণ্টন।</p>
        <div class="card-url">admission.cu.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://admission.cu.ac.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card alt" data-category="university" data-keywords="jahangirnagar university ju admission result জাহাঙ্গীরনগর বিশ্ববিদ্যালয়">
        <div class="card-top"><h3>জাহাঙ্গীরনগর বিশ্ববিদ্যালয় (JU)</h3><span class="badge admission">জাবি পোর্টাল</span></div>
        <p>জাহাঙ্গীরনগর বিশ্ববিদ্যালয়ের সকল ইউনিটের লিখিত ভর্তি পরীক্ষার রেজাল্ট ও মেধা ক্রম।</p>
        <div class="card-url">ju-admission.org</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://ju-admission.org" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ 05: MEDICAL, DENTAL & NURSING ============ -->
  <section id="medical">
    <div class="section-head">
      <span class="section-num">05</span>
      <h2>মেডিকেল, ডেন্টাল, নার্সিং ও সশস্ত্র বাহিনী চিকিৎসা ভর্তি</h2>
    </div>
    <p class="section-desc">স্বাস্থ্য অধিদপ্তর (DGHS) ও নার্সিং কাউন্সিল পরিচালিত সরকারি ও বেসরকারি এমবিবিএস, বিডিএস এবং নার্সিং ভর্তি পরীক্ষার রেজাল্ট।</p>
    <div class="grid">
      <div class="card" data-category="medical" data-keywords="mbbs medical admission dghs teletalk মেডিকেল ভর্তি ফলাফল">
        <div class="card-top"><h3>এমবিবিএস মেডিকেল ভর্তি ফলাফল (MBBS)</h3><span class="badge medical">স্বাস্থ্য অধিদপ্তর</span></div>
        <p>স্বাস্থ্য শিক্ষা অধিদপ্তর (DGME) পরিচালিত সরকারি ও বেসরকারি মেডিকেল কলেজের এমবিবিএস ভর্তি পরীক্ষার মেধা তালিকা।</p>
        <div class="card-url">result.dghs.gov.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://result.dghs.gov.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card alt" data-category="medical" data-keywords="bds dental admission result ডেন্টাল ভর্তি ফলাফল">
        <div class="card-top"><h3>বিডিএস ডেন্টাল ভর্তি ফলাফল (BDS)</h3><span class="badge medical">স্বাস্থ্য অধিদপ্তর</span></div>
        <p>সরকারি ও বেসরকারি ডেন্টাল কলেজ ও ডেন্টাল ইউনিটের বিডিএস (BDS) ভর্তি পরীক্ষার ফলাফল।</p>
        <div class="card-url">result.dghs.gov.bd/bds</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://result.dghs.gov.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card" data-category="medical" data-keywords="nursing bnmc teletalk bsc diploma midwifery নার্সিং ভর্তি ফলাফল">
        <div class="card-top"><h3>নার্সিং ও মিডওয়াইফারি ভর্তি (BNMC)</h3><span class="badge medical">বিএনএমসি</span></div>
        <p>বিএসসি ইন নার্সিং, ডিপ্লোমা ইন নার্সিং সায়েন্স এবং মিডওয়াইফারি ভর্তি পরীক্ষার বাংলাদেশ নার্সিং কাউন্সিল ফলাফল।</p>
        <div class="card-url">bnmc.teletalk.com.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://bnmc.teletalk.com.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card alt" data-category="medical" data-keywords="afmc amc armed forces medical college এএফএমসি ভর্তি">
        <div class="card-top"><h3>আর্মড ফোর্সেস মেডিকেল (AFMC & AMC)</h3><span class="badge medical">সশস্ত্র বাহিনী</span></div>
        <p>আর্মড ফোর্সেস মেডিকেল কলেজ এবং ৫টি আর্মি মেডিকেল কলেজের এমবিবিএস ভর্তি পরীক্ষার রেজাল্ট।</p>
        <div class="card-url">afmc.teletalk.com.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://afmc.teletalk.com.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ 06: NATIONAL UNIV, BOU & POLYTECHNIC DIPLOMA ============ -->
  <section id="nu-bteb">
    <div class="section-head">
      <span class="section-num">06</span>
      <h2>জাতীয় বিশ্ববিদ্যালয়, উন্মুক্ত বিশ্ববিদ্যালয় ও কারিগরি শিক্ষা</h2>
    </div>
    <p class="section-desc">জাতীয় বিশ্ববিদ্যালয় (NU) অনার্স, ডিগ্রি ও মাস্টার্স; বাংলাদেশ উন্মুক্ত বিশ্ববিদ্যালয় (BOU) এবং কারিগরি শিক্ষা বোর্ডের (BTEB) ডিপ্লোমা ফলাফল।</p>
    <div class="grid">
      <div class="card" data-category="nu-bteb" data-keywords="nu national university honours degree masters results জাতীয় বিশ্ববিদ্যালয় ফলাফল">
        <div class="card-top"><h3>জাতীয় বিশ্ববিদ্যালয় (NU Results)</h3><span class="badge nu">এনইউ পোর্টাল</span></div>
        <p>জাতীয় বিশ্ববিদ্যালয়ের অনার্স ১ম, ২য়, ৩য়, ৪র্থ বর্ষ, ডিগ্রি পাস ও মাস্টার্স পরীক্ষার বিষয়ভিত্তিক সিজিপিএ ও রেজাল্ট।</p>
        <div class="card-url">results.nu.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://results.nu.ac.bd/" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card alt" data-category="nu-bteb" data-keywords="nu admission honours degree masters national university admission জাতীয় বিশ্ববিদ্যালয় ভর্তি">
        <div class="card-top"><h3>জাতীয় বিশ্ববিদ্যালয় ভর্তি ফলাফল</h3><span class="badge nu">এনইউ ভর্তি</span></div>
        <p>জাতীয় বিশ্ববিদ্যালয়ের অনার্সে ১ম বর্ষ ভর্তি, রিলিজ স্লিপ এবং ডিগ্রি/মাস্টার্স ভর্তির মেধা তালিকা পোর্টাল।</p>
        <div class="card-url">app1.nu.edu.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="http://app1.nu.edu.bd/" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card" data-category="nu-bteb" data-keywords="bou open university ssc hsc degree honours result উন্মুক্ত বিশ্ববিদ্যালয় ফলাফল">
        <div class="card-top"><h3>বাংলাদেশ উন্মুক্ত বিশ্ববিদ্যালয় (BOU)</h3><span class="badge nu">বাউবি পোর্টাল</span></div>
        <p>বাউবি (BOU) এসএসসি, এইচএসসি, বিএ, বিএসএস, বিবিএ এবং বিএড পরীক্ষার অফিসিয়াল সিজিপিএ রেজাল্ট পোর্টাল।</p>
        <div class="card-url">exam.bou.ac.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://exam.bou.ac.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card alt" data-category="nu-bteb" data-keywords="bteb polytechnic diploma engineering textile marine কারিগরি ডিপ্লোমা ফলাফল">
        <div class="card-top"><h3>কারিগরি ডিপ্লোমা ইন ইঞ্জিনিয়ারিং (BTEB)</h3><span class="badge bteb">বিটিইবি</span></div>
        <p>পলিটেকনিক ইনস্টিটিউটের ডিপ্লোমা ইন ইঞ্জিনিয়ারিং, টেক্সটাইল, মেরিন ও এগ্রিকালচার পরীক্ষার সেমিস্টার ফাইনাল রেজাল্ট।</p>
        <div class="card-url">btebresult.gov.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://btebresult.gov.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ 07: JOB EXAMS (BCS, NTRCA, PRIMARY TEACHER, BANK, RAILWAY) ============ -->
  <section id="job-exams">
    <div class="section-head">
      <span class="section-num">07</span>
      <h2>সরকারি, শিক্ষক নিবন্ধন, ব্যাংক ও অন্যান্য চাকুরী পরীক্ষা</h2>
    </div>
    <p class="section-desc">বিসিএস (BCS), এনটিআরসিএ (NTRCA), প্রাথমিক শিক্ষক নিয়োগ, কম্বাইন্ড ব্যাংক জব, রেলওয়ে, বিজেসি ও সরকারি দপ্তরসমূহের রেজাল্ট।</p>
    <div class="grid">
      <div class="card" data-category="job" data-keywords="bcs bpsc preliminary written viva result বিসিএস পরীক্ষা ফলাফল">
        <div class="card-top"><h3>বিসিএস পরীক্ষা ফলাফল (BPSC)</h3><span class="badge job">বিপিএসসি</span></div>
        <p>বাংলাদেশ সরকারি কর্ম কমিশন (BPSC) পরিচালিত বিসিএস প্রিলিমিনারি, লিখিত এবং ভাইভা পরীক্ষার ফলাফল ও ক্যাডার গেজেট।</p>
        <div class="card-url">bpsc.gov.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://bpsc.gov.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card alt" data-category="job" data-keywords="ntrca teacher registration result শিক্ষক নিবন্ধন ফলাফল">
        <div class="card-top"><h3>এনটিআরসিএ শিক্ষক নিবন্ধন (NTRCA)</h3><span class="badge job">এনটিআরসিএ</span></div>
        <p>বেসরকারি শিক্ষক নিবন্ধন ও প্রত্যয়ন কর্তৃপক্ষ (NTRCA) পরিচালিত শিক্ষক নিবন্ধন পরীক্ষা ও গণবিজ্ঞপ্তি রেজাল্ট।</p>
        <div class="card-url">ntrca.teletalk.com.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="http://ntrca.teletalk.com.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card" data-category="job" data-keywords="primary teacher recruitment dpe teletalk প্রাথমিক শিক্ষক নিয়োগ ফলাফল">
        <div class="card-top"><h3>প্রাথমিক সরকারি শিক্ষক নিয়োগ (DPE)</h3><span class="badge job">ডিপিই শিক্ষক</span></div>
        <p>প্রাথমিক সহকারী শিক্ষক নিয়োগ পরীক্ষার ধাপভিত্তিক প্রিলিমিনারি, লিখিত ও চূড়ান্ত ভাইভা রেজাল্ট।</p>
        <div class="card-url">dpe.portal.gov.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://dpe.portal.gov.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card alt" data-category="job" data-keywords="bank job bangladesh bank combined bank recruitment ব্যাংক জব ফলাফল">
        <div class="card-top"><h3>কম্বাইন্ড ব্যাংক ও বাংলাদেশ ব্যাংক জব</h3><span class="badge job">বাংলাদেশ ব্যাংক</span></div>
        <p>বাংলাদেশ ব্যাংক কর্তৃক সমন্বিত ৯টি সরকারি ব্যাংক ও আর্থিক প্রতিষ্ঠানের অফিসার/সিনিয়র অফিসার চাকুরীর নিয়োগ রেজাল্ট।</p>
        <div class="card-url">erecruitment.bb.org.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://erecruitment.bb.org.bd" target="_blank" rel="noopener">ফlaফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card" data-category="job" data-keywords="bpsc non cadre result বিপিএসসি নন ক্যাডার">
        <div class="card-top"><h3>বিপিএসসি নন-ক্যাডার পরীক্ষা (BPSC Non-Cadre)</h3><span class="badge job">নন-ক্যাডার</span></div>
        <p>নবম, দশম এবং অন্যান্য গ্রেডের সরকারি নন-ক্যাডার পদের নিয়োগ পরীক্ষার ফলাফল ও সুপারিশমালা।</p>
        <div class="card-url">bpsc.gov.bd/site/view/psc_results</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://bpsc.gov.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card alt" data-category="job" data-keywords="railway br teletalk bangladesh railway recruitment বাংলাদেশ রেলওয়ে নিয়োগ">
        <div class="card-top"><h3>বাংলাদেশ রেলওয়ে নিয়োগ পরীক্ষা (BR)</h3><span class="badge job">রেলওয়ে</span></div>
        <p>বাংলাদেশ রেলওয়ের বিভিন্ন ক্যাটাগরির নিয়োগ পরীক্ষার প্রিলিমিনারি, লিখিত ও ভাইভার ফলাফল।</p>
        <div class="card-url">br.teletalk.com.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://br.teletalk.com.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card" data-category="job" data-keywords="bjc judicial service assistant judge বাংলাদেশ জুডিশিয়াল সার্ভিস">
        <div class="card-top"><h3>বাংলাদেশ জুডিশিয়াল সার্ভিস (BJC)</h3><span class="badge job">জুডিশিয়ারি</span></div>
        <p>সহকারী জাজ নিয়োগের বিজেএসসি (BJSC) প্রিলিমিনারি, লিখিত ও মনস্তাত্ত্বিক পরীক্ষার রেজাল্ট।</p>
        <div class="card-url">bjc.gov.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="http://www.bjc.gov.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>

      <div class="card alt" data-category="job" data-keywords="defense army navy airforce recruitment সশস্ত্র বাহিনী নিয়োগ">
        <div class="card-top"><h3>সশস্ত্র বাহিনী ও পুলিশ নিয়োগ (Defense)</h3><span class="badge job">সশস্ত্র বাহিনী</span></div>
        <p>বাংলাদেশ সেনাবাহিনী, নৌবাহিনী, বিমান বাহিনী, বিজিবি এবং বাংলাদেশ পুলিশ নিয়োগ পরীক্ষার ফলাফল।</p>
        <div class="card-url">joinbangladesharmy.army.mil.bd</div>
        <div class="card-actions">
          <a class="link-btn primary" href="https://joinbangladesharmy.army.mil.bd" target="_blank" rel="noopener">ফলাফল দেখুন ↗</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ 08: BOARDS DIRECTORY ============ -->
  <section id="boards">
    <div class="section-head">
      <span class="section-num">08</span>
      <h2>১১টি শিক্ষা বোর্ড ডিরেক্টরি</h2>
    </div>
    <p class="section-desc">বাংলাদেশের ৯টি সাধারণ শিক্ষা বোর্ড, ১টি মাদ্রাসা শিক্ষা বোর্ড এবং ১টি কারিগরি শিক্ষা বোর্ডের অফিসিয়াল ওয়েবসাইট লিঙ্কসমূহ।</p>
    <table class="board-table">
      <thead>
        <tr><th>বোর্ডের নাম</th><th>ধরন</th><th>অফিসিয়াল ওয়েবসাইট</th></tr>
      </thead>
      <tbody>
        <tr class="board-row" data-category="board" data-keywords="dhaka board ঢাকা বোর্ড"><td>ঢাকা শিক্ষা বোর্ড (Dhaka Board)</td><td>সাধারণ</td><td><a href="https://www.dhakaeducationboard.gov.bd" target="_blank" rel="noopener">dhakaeducationboard.gov.bd</a></td></tr>
        <tr class="board-row" data-category="board" data-keywords="rajshahi board রাজশাহী বোর্ড"><td>রাজশাহী শিক্ষা বোর্ড (Rajshahi Board)</td><td>সাধারণ</td><td><a href="http://www.rajshahieducationboard.gov.bd" target="_blank" rel="noopener">rajshahieducationboard.gov.bd</a></td></tr>
        <tr class="board-row" data-category="board" data-keywords="comilla board কুমিল্লা বোর্ড"><td>কুমিল্লা শিক্ষা বোর্ড (Comilla Board)</td><td>সাধারণ</td><td><a href="https://comillaboard.portal.gov.bd" target="_blank" rel="noopener">comillaboard.portal.gov.bd</a></td></tr>
        <tr class="board-row" data-category="board" data-keywords="jessore board যশোর বোর্ড"><td>যশোর শিক্ষা বোর্ড (Jessore Board)</td><td>সাধারণ</td><td><a href="https://www.jessoreboard.gov.bd" target="_blank" rel="noopener">jessoreboard.gov.bd</a></td></tr>
        <tr class="board-row" data-category="board" data-keywords="chittagong board চট্টগ্রাম বোর্ড"><td>চট্টগ্রাম শিক্ষা বোর্ড (Chittagong Board)</td><td>সাধারণ</td><td><a href="https://bise-ctg.portal.gov.bd" target="_blank" rel="noopener">bise-ctg.portal.gov.bd</a></td></tr>
        <tr class="board-row" data-category="board" data-keywords="barisal board বরিশাল বোর্ড"><td>বরিশাল শিক্ষা বোর্ড (Barisal Board)</td><td>সাধারণ</td><td><a href="https://www.barisalboard.gov.bd" target="_blank" rel="noopener">barisalboard.gov.bd</a></td></tr>
        <tr class="board-row" data-category="board" data-keywords="sylhet board সিলেট বোর্ড"><td>সিলেট শিক্ষা বোর্ড (Sylhet Board)</td><td>সাধারণ</td><td><a href="https://sylhetboard.gov.bd" target="_blank" rel="noopener">sylhetboard.gov.bd</a></td></tr>
        <tr class="board-row" data-category="board" data-keywords="dinajpur board দিনাজপুর বোর্ড"><td>দিনাজপুর শিক্ষা বোর্ড (Dinajpur Board)</td><td>সাধারণ</td><td><a href="http://dinajpureducationboard.gov.bd" target="_blank" rel="noopener">dinajpureducationboard.gov.bd</a></td></tr>
        <tr class="board-row" data-category="board" data-keywords="mymensingh board ময়মনসিংহ বোর্ড"><td>ময়মনসিংহ শিক্ষা বোর্ড (Mymensingh Board)</td><td>সাধারণ</td><td><a href="https://mymensinghboard.gov.bd" target="_blank" rel="noopener">mymensinghboard.gov.bd</a></td></tr>
        <tr class="board-row" data-category="board" data-keywords="madrasah board bmeb মাদ্রাসা বোর্ড"><td>বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড (BMEB)</td><td>দাখিল / আলিম</td><td><a href="http://www.bmeb.gov.bd" target="_blank" rel="noopener">bmeb.gov.bd</a></td></tr>
        <tr class="board-row" data-category="board" data-keywords="technical board bteb কারিগরি বোর্ড"><td>বাংলাদেশ কারিগরি শিক্ষা বোর্ড (BTEB)</td><td>ভোকেশনাল / ডিপ্লোমা</td><td><a href="https://bteb.gov.bd" target="_blank" rel="noopener">bteb.gov.bd</a></td></tr>
      </tbody>
    </table>
  </section>

  <!-- ============ 09: SMS SYSTEM ============ -->
  <section id="sms">
    <div class="section-head">
      <span class="section-num">09</span>
      <h2>ইন্টারনেট ছাড়া এসএমএস (SMS) দিয়ে ফলাফল</h2>
    </div>
    <p class="section-desc">মোবাইল থেকে মাত্র একটি এসএমএস পাঠিয়ে যেকোনো শিক্ষা বোর্ডের ফলাফল জানুন (যেকোনো অপারেটর থেকে ১৬২২২ নম্বরে পাঠাতে হবে)।</p>
    <div class="sms-box">
      <div class="sms-item" data-category="sms" data-keywords="sms ssc hsc dakhil alim 16222 এসএমএস রেজাল্ট">
        <h3>এসএসসি / এইচএসসি ও সমমান (SSC / HSC)</h3>
        <p>ফরম্যাট: <span class="mono">EXAM BOARD ROLL YEAR</span>, পাঠান <strong>16222</strong> নম্বরে।</p>
        <div class="sms-example">SSC DHA 123456 2024<br>send to 16222</div>
        <p style="margin-top:10px;">উদাহরণস্বরূপ: এইচএসসি-র জন্য <span class="mono">HSC DHA 123456 2024</span>, দাখিলের জন্য <span class="mono">DAKHIL MAD 123456 2024</span>, ভোকেশনালের জন্য <span class="mono">SSC TEC 123456 2024</span>।</p>
      </div>
      <div class="sms-item" data-category="sms" data-keywords="sms primary dpe 16222 প্রাথমিক এসএমএস">
        <h3>প্রাথমিক ও ইবতেদায়ী সমাপনী (PEC / DPE)</h3>
        <p>ফরম্যাট: <span class="mono">DPE ROLL YEAR</span>, পাঠান <strong>16222</strong> নম্বরে।</p>
        <div class="sms-example">DPE 123456 2024<br>send to 16222</div>
        <p style="margin-top:10px;">ইবতেদায়ী ফলাফলের জন্য DPE এর স্থলে <span class="mono">EBT</span> লিখে স্পেস দিয়ে রোল ও সাল লিখে ১৬২২২ তে পাঠান।</p>
      </div>
    </div>
  </section>

  <!-- ============ 10: FAQ ============ -->
  <section id="faq">
    <div class="section-head">
      <span class="section-num">10</span>
      <h2>সাধারণ জিজ্ঞাসা (FAQ)</h2>
    </div>
    <div class="faq-list">
      <details class="faq-item" data-category="faq" data-keywords="faq ssc result এসএসসি ফলাফল কিভাবে দেখব">
        <summary class="faq-question">এসএসসি বা এইচএসসি মার্কশিট কিভাবে ডাউনলোড করব?</summary>
        <div class="faq-answer">
          <p>সম্পূর্ণ বিষয়ভিত্তিক নম্বরপত্রসহ এসএসসি ও এইচএসসি ফলাফল পেতে <a href="https://www.eboardresults.com" target="_blank" rel="noopener">eboardresults.com</a> সাইটে যান। সেখানে পরীক্ষা, বছর, বোর্ড নির্বাচন করে 'Individual Result' বাটনে রোল ও রেজিস্ট্রেশন নম্বর লিখলে ফুল মার্কশিট পাওয়া যাবে।</p>
        </div>
      </details>
      <details class="faq-item" data-category="faq" data-keywords="faq nu result national university জাতীয় বিশ্ববিদ্যালয় ফলাফল">
        <summary class="faq-question">জাতীয় বিশ্ববিদ্যালয়ের (NU) অনার্স/ডিগ্রি ফলাফল কোথায় পাওয়া যাবে?</summary>
        <div class="faq-answer">
          <p>জাতীয় বিশ্ববিদ্যালয়ের অনার্স ১ম থেকে ৪র্থ বর্ষ, ডিগ্রি এবং মাস্টার্স ফলাফল <a href="https://results.nu.ac.bd/" target="_blank" rel="noopener">results.nu.ac.bd</a> লিংকে পাওয়া যায়। রেজিস্ট্রেশন নম্বর ও পরীক্ষার বছর লিখে সার্চ করলেই আপনার বিস্তারিত জিপিএ/সিজিপিএ দেখা যাবে।</p>
        </div>
      </details>
      <details class="faq-item" data-category="faq" data-keywords="faq medical result মেডিকেল ভর্তি ফলাফল">
        <summary class="faq-question">মেডিকেল (MBBS) ও ডেন্টাল (BDS) ভর্তি ফলাফল দেখার নিয়ম কী?</summary>
        <div class="faq-answer">
          <p>মেডিকেল ও ডেন্টাল ভর্তি ফলাফল স্বাস্থ্য অধিদপ্তরের সরকারি পোর্টাল <a href="https://result.dghs.gov.bd" target="_blank" rel="noopener">result.dghs.gov.bd</a>-এ প্রকাশিত হয়। আপনার রোল নম্বর দিয়ে লগইন করলে মেধা স্থান ও বরাদ্দকৃত সরকারি/বেসরকারি কলেজের নাম দেখা যাবে।</p>
        </div>
      </details>
      <details class="faq-item" data-category="faq" data-keywords="faq bcs result বিসিএস ফলাফল">
        <summary class="faq-question">বিসিএস পরীক্ষার ফলাফল কিভাবে চেক করব?</summary>
        <div class="faq-answer">
          <p>বাংলাদেশ সরকারি কর্ম কমিশনের (BPSC) ওয়েবসাইট <a href="https://bpsc.gov.bd" target="_blank" rel="noopener">bpsc.gov.bd</a> অথবা টেলিটক পোর্টাল <a href="https://bpsc.teletalk.com.bd" target="_blank" rel="noopener">bpsc.teletalk.com.bd</a>-এ বিসিএস প্রিলি, লিখিত ও ভাইভার রেজাল্ট পিডিএফ ও সার্চ আকারে পাওয়া যায়।</p>
        </div>
      </details>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
