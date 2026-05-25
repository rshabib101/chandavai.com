<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Create Report</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/habib-custom.css') }}">
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#f0f2f5;
    font-family:'Poppins', sans-serif;
    padding:30px 15px;
}

/* FORM CONTAINER */
.form-box{
    max-width:650px;
    margin:auto;
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    animation:fadeUp 0.5s ease;
}

/* TITLE */
.form-title{
    font-size:28px;
    font-weight:800;
    margin-bottom:20px;
    color:#111827;
    text-align:center;
}

/* LABEL */
label{
    font-size:14px;
    font-weight:600;
    color:#374151;
    margin-bottom:8px;
    display:block;
}

/* INPUT */
.input-box{
    width:100%;
    padding:13px 15px;
    border:1px solid #d1d5db;
    border-radius:12px;
    outline:none;
    margin-bottom:15px;
    font-size:14px;
    transition:0.3s;
    background:#f9fafb;
}

/* FOCUS EFFECT */
.input-box:focus{
    border-color:#1877f2;
    background:white;
    box-shadow:0 0 0 4px rgba(24,119,242,0.15);
    transform:translateY(-1px);
}

/* TEXTAREA */
textarea.input-box{
    min-height:140px;
    resize:none;
}

/* FILE INPUT */
.file-box{
    background:#f9fafb;
    padding:10px;
    border-radius:12px;
    border:1px dashed #cbd5e1;
    margin-bottom:15px;
}

/* SUBMIT BUTTON */
.submit-btn{
    width:100%;
    border:none;
    background:linear-gradient(135deg,#1877f2,#0d6efd);
    color:white;
    padding:15px;
    border-radius:14px;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
    transition:0.3s;
    position:relative;
    overflow:hidden;
}

/* HOVER */
.submit-btn:hover{
    transform:translateY(-2px) scale(1.01);
    box-shadow:0 10px 20px rgba(24,119,242,0.25);
}

/* CLICK */
.submit-btn:active{
    transform:scale(0.97);
}

/* SHINE EFFECT */
.submit-btn::before{
    content:'';
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:rgba(255,255,255,0.2);
    transition:0.5s;
}

.submit-btn:hover::before{
    left:100%;
}

/* CARD ANIMATION */
@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* MOBILE */
@media(max-width:768px){
    .form-box{
        padding:18px;
    }
    .form-title{
        font-size:24px;
    }
}
</style>
</head>
<body>

<div class="form-box">

    <h1 class="form-title">
        ➕ Create Report
    </h1>

    <form method="POST" action="/report/store" enctype="multipart/form-data">
        @csrf

        <!-- TITLE -->
        <label>Report Title</label>
        <input type="text" name="title" class="input-box" placeholder="Enter report title" required>

        <!-- DESCRIPTION -->
        <label>Description</label>
        <textarea name="description" class="input-box" placeholder="Write full details..." required></textarea>

        <!-- DIVISION -->
        <label>Division</label>
        <select id="division" name="division_id" class="input-box"> <!-- name="division_id" যুক্ত করা হয়েছে -->
            <option value="">Select Division</option>
        </select>

        <!-- DISTRICT -->
        <label>District</label>
        <select id="district" name="district_id" class="input-box"> <!-- name="district_id" যুক্ত করা হয়েছে -->
            <option value="">Select District</option>
        </select>

        <!-- THANA -->
        <label>Thana / Upazila</label>
        <select id="upazila" name="location" class="input-box"> <!-- name="location" যুক্ত করা হয়েছে কন্ট্রোলারের সাথে মিলিয়ে -->
            <option value="">Select Thana</option>
        </select>

        <!-- CATEGORY -->
        <label>Category</label>
        <input type="text" name="category" class="input-box" placeholder="Example: Corruption / Crime">

        <!-- IMAGE -->
        <label>Upload Image</label>
        <div class="file-box">
            <input type="file" name="image">
        </div>

        <!-- VIDEO -->
        <label>YouTube Video URL</label>
        <input type="text" name="video_url" class="input-box" placeholder="Paste YouTube video link">

        <!-- SUBMIT -->
        <button type="submit" class="submit-btn">
            🚀 Submit Report
        </button>
    </form>
</div>

<!-- LOCATION SCRIPT -->
<script>
let divisions = [];
let districts = [];
let upazilas = [];

// LOAD DIVISIONS
fetch('/location/divisions.json')
.then(res => res.json())
.then(data => {
    divisions = data[2].data;
    let divisionSelect = document.getElementById('division');

    divisions.forEach(div => {
        divisionSelect.innerHTML += `
        <option value="${div.id}">
            ${div.bn_name}
        </option>`;
    });
});

// LOAD DISTRICTS
fetch('/location/districts.json')
.then(res => res.json())
.then(data => {
    districts = data[2].data;
});

// LOAD UPAZILAS
fetch('/location/upazilas.json')
.then(res => res.json())
.then(data => {
    upazilas = data[2].data;
});

// DIVISION CHANGE
document.getElementById('division').addEventListener('change', function(){
    let district = document.getElementById('district');
    let upazila = document.getElementById('upazila');

    // নতুন বিভাগ সিলেক্ট করলে জেলা এবং থানা দুটোই রিসেট হবে
    district.innerHTML = '<option value="">Select District</option>';
    upazila.innerHTML = '<option value="">Select Thana</option>';

    let filtered = districts.filter(d => d.division_id == this.value);

    filtered.forEach(d => {
        district.innerHTML += `
        <option value="${d.id}">
            ${d.bn_name}
        </option>`;
    });
});

// DISTRICT CHANGE
document.getElementById('district').addEventListener('change', function(){
    let upazila = document.getElementById('upazila');

    upazila.innerHTML = '<option value="">Select Thana</option>';

    let filtered = upazilas.filter(u => u.district_id == this.value);

    filtered.forEach(u => {
        upazila.innerHTML += `
        <option value="${u.id}">
            ${u.bn_name}
        </option>`;
    });
});
</script>

</body>
</html>