<?php
$siteName = 'ফলাফল সেতু';
$siteDescription = 'ফলাফল সেতু বিডি — সব পরীক্ষার ফলাফল ডিরেক্টরি';
$currentYear = date('Y');
$bdTodayDate = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
$todayBn = $bdTodayDate->format('d F Y');
$canonicalUrl = 'https://examresultsbd.online/';
$pageTitle = $siteName . ' — বাংলাদেশের সব পরীক্ষার ফলাফল ডিরেক্টরি | এসএসসি এইচএসসি দাখিল আলিম পিএসসি ভোকেশনাল বিশ্ববিদ্যালয় ভর্তি চাকুরী ফলাফল';
$metaDescription = 'বাংলাদেশের সকল পরীক্ষার ফলাফল ডিরেক্টরি — এসএসসি, এইচএসসি, দাখিল, আলিম, পিএসসি, ভোকেশনাল, গুচ্ছ ভর্তি, জাতীয় বিশ্ববিদ্যালয়, ঢাকা বিশ্ববিদ্যালয়, বুয়েট, বিসিএস, ব্যাংক জব এবং সব সরকারি চাকুরী পরীক্ষার ফলাফল অফিসিয়াল লিংক।';
$ogImage = 'https://examresultsbd.online/logo.png';
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $pageTitle; ?></title>
<meta name="description" content="<?php echo $metaDescription; ?>">
<meta name="keywords" content="ফলাফল সেতু, এসএসসি ফলাফল, এইচএসসি ফলাফল, দাখিল ফলাফল, আলিম ফলাফল, পিএসসি ফলাফল, ভোকেশনাল ফলাফল, বিশ্ববিদ্যালয় ভর্তি ফলাফল, গুচ্ছ ভর্তি ফলাফল, জাতীয় বিশ্ববিদ্যালয় ফলাফল, ঢাকা বিশ্ববিদ্যালয় ফলাফল, বুয়েট ভর্তি ফলাফল, বিসিএস ফলাফল, ব্যাংক জব ফলাফল, চাকুরী পরীক্ষার ফলাফল, বাংলাদেশ পরীক্ষার ফলাফল, education board result, bd result, exam result bd, ssc hsc result, bangladesh exam result">
<meta name="author" content="<?php echo $siteName; ?>">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<link rel="canonical" href="<?php echo $canonicalUrl; ?>">
<link rel="alternate" hreflang="bn-BD" href="<?php echo $canonicalUrl; ?>">
<link rel="alternate" hreflang="en-BD" href="<?php echo $canonicalUrl; ?>">
<link rel="alternate" hreflang="x-default" href="<?php echo $canonicalUrl; ?>">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo $canonicalUrl; ?>">
<meta property="og:title" content="<?php echo $pageTitle; ?>">
<meta property="og:description" content="<?php echo $metaDescription; ?>">
<meta property="og:image" content="<?php echo $ogImage; ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale" content="bn_BD">
<meta property="og:site_name" content="<?php echo $siteName; ?>">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="<?php echo $canonicalUrl; ?>">
<meta name="twitter:title" content="<?php echo $pageTitle; ?>">
<meta name="twitter:description" content="<?php echo $metaDescription; ?>">
<meta name="twitter:image" content="<?php echo $ogImage; ?>">

<!-- Geo -->
<meta name="geo.region" content="BD">
<meta name="geo.placename" content="Dhaka, Bangladesh">
<meta name="geo.position" content="23.8103;90.4125">
<meta name="ICBM" content="23.8103, 90.4125">

<!-- Preconnect -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://www.googletagmanager.com">
<link rel="preconnect" href="https://result.bangladeshgov.org">
<link rel="preconnect" href="https://eduboardapi.vercel.app">
<link rel="dns-prefetch" href="https://www.eboardresults.com">
<link rel="dns-prefetch" href="https://www.educationboardresults.gov.bd">
<link rel="dns-prefetch" href="https://gstadmission.ac.bd">
<link rel="dns-prefetch" href="https://results.nu.ac.bd">
<link rel="dns-prefetch" href="https://bpsc.gov.bd">

<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Noto+Serif+Bengali:wght@500;600;700&family=Noto+Sans+Bengali:wght@400;500;600&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZRLTVZLNN1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-ZRLTVZLNN1', { 'page_path': window.location.pathname });
</script>

<!-- Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "<?php echo $siteName; ?>",
  "description": "<?php echo $siteDescription; ?>",
  "url": "<?php echo $canonicalUrl; ?>",
  "inLanguage": "bn-BD",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "<?php echo $canonicalUrl; ?>?search={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "<?php echo $siteName; ?>",
  "url": "<?php echo $canonicalUrl; ?>",
  "logo": "<?php echo $ogImage; ?>",
  "description": "<?php echo $siteDescription; ?>",
  "sameAs": [
    "https://www.eboardresults.com",
    "https://www.educationboardresults.gov.bd"
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "হোম",
      "item": "<?php echo $canonicalUrl; ?>"
    }
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "এসএসসি ফলাফল কিভাবে দেখব?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "এসএসসি ফলাফল দেখতে educaciónboardresults.gov.bd/result অথবা eboardresults.com-এ যান। রোল নম্বর এবং রেজিস্ট্রেশন নম্বর দিন।"
      }
    },
    {
      "@type": "Question",
      "name": "এইচএসসি ফলাফল কখন প্রকাশিত হবে?",
      "@type": "Question",
      "name": "বিসিএস চাকুরী ফলাফল কোথায় পাওয়া যায়?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "বিসিএস চাকুরী ফলাফলbpsc.gov.bd-এ প্রকাশিত হয়। সাইটে যান এবং নোটিশ দেখুন।"
      }
    },
    {
      "@type": "Question",
      "name": "জাতীয় বিশ্ববিদ্যালয় ফলাফল কোথায় দখল করা যায়?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "জাতীয় বিশ্ববিদ্যালয়ের ফলাফল results.nu.ac.bd-এ পাওয়া যায়।"
      }
    }
  ]
}
</script>

<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="memo-strip" itemscope itemtype="https://schema.org/WPHeader">
  <span itemprop="headline">অনানুষ্ঠানিক ডিরেক্টরি · কোনো সরকারি ওয়েবসাইট নয়</span>
  <span id="clock" itemprop="datePublished"><?php echo $bdTodayDate->format('H:i:s'); ?> BDT</span>
</div>

<header class="site" role="banner">
  <div class="site-inner">
    <div class="brand" itemscope itemtype="https://schema.org/Organization">
      <div class="seal" aria-hidden="true">ফ</div>
      <div class="brand-text">
        <span class="bn" itemprop="name"><?php echo $siteName; ?></span>
        <small itemprop="description"><?php echo $siteDescription; ?></small>
      </div>
    </div>
    <nav class="main" role="navigation" aria-label="প্রধান নেভিগেশন">
      <a href="#search-section">🔍 অনুসন্ধান</a>
      <a href="#secondary">মাধ্যমিক (SSC)</a>
      <a href="#higher-secondary">উচ্চ মাধ্যমিক (HSC)</a>
      <a href="#primary">প্রাথমিক (PEC)</a>
      <a href="#university">বিশ্ববিদ্যালয় ভর্তি</a>
      <a href="#medical">মেডিকেল ও নার্সিং</a>
      <a href="#nu-bteb">জাতীয় ও কারিগরি</a>
      <a href="#job-exams">চাকুরী পরীক্ষা</a>
      <a href="#boards">শিক্ষা বোর্ড</a>
      <a href="#sms">এসএমএস পদ্ধতি</a>
    </nav>
  </div>
</header>
