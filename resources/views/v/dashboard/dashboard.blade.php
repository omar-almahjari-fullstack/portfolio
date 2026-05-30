<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لوحة التحكم</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Tajawal', sans-serif; background:#0a192f; color:#e6f1ff; padding:2rem }
        .card { background: rgba(255,255,255,0.03); padding:1rem; border-radius:8px; margin-bottom:1rem }
        .btn { background:#00ffff; color:#022; padding:0.5rem 1rem; border-radius:6px; border:none; cursor:pointer }
        form input, form textarea { width:100%; padding:0.5rem; margin-bottom:0.5rem; border-radius:6px; border:1px solid rgba(255,255,255,0.06); background:transparent; color:inherit }
    </style>
</head>
<body>
    <h1>لوحة التحكم</h1>

    <section class="card">
        <h2>نبذة عني</h2>
        @if($about)
            <p><strong>الاسم:</strong> {{ $about->name }}</p>
            <p><strong>نبذة:</strong> {{ $about->bio }}</p>
            <p>{{ $about->description }}</p>
        @else
            <p>لا توجد بيانات عني حتى الآن.</p>
        @endif
    </section>

    <section class="card">
        <h2>المشاريع</h2>
        <div id="projectsList">
            @foreach($projects as $project)
                <div class="project-item" data-id="{{ $project->id }}">
                    <h3>{{ $project->title }}</h3>
                    <p>{{ $project->description }}</p>
                    <a href="{{ $project->url }}">رابط المشروع</a>
                    <button class="btn btn-delete" data-id="{{ $project->id }}">حذف</button>
                </div>
            @endforeach
        </div>

        <h3>إضافة مشروع</h3>
        <form id="projectForm">
            <input type="text" id="pTitle" placeholder="عنوان المشروع" required>
            <textarea id="pDesc" placeholder="وصف المشروع"></textarea>
            <input type="text" id="pUrl" placeholder="رابط المشروع">
            <button class="btn" type="submit">إنشاء</button>
        </form>
    </section>

    <section class="card">
        <h2>الخدمات</h2>
        <ul>
            @foreach($services as $s)
                <li>{{ $s->title }} - {{ $s->description }}</li>
            @endforeach
        </ul>
    </section>

    <section class="card">
        <h2>الخبرات</h2>
        <ul>
            @foreach($experiences as $e)
                <li>{{ $e->title }} | {{ $e->company }} | {{ $e->duration }}</li>
            @endforeach
        </ul>
    </section>

    <script>
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.getElementById('projectForm').addEventListener('submit', async function(e){
            e.preventDefault();
            const title = document.getElementById('pTitle').value;
            const description = document.getElementById('pDesc').value;
            const url = document.getElementById('pUrl').value;

            const res = await fetch('/api/projects', {
                method:'POST',
                headers: {
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept':'application/json'
                },
                body: JSON.stringify({ title, description, url })
            });

            if (res.ok) {
                const data = await res.json();
                // append to list
                const list = document.getElementById('projectsList');
                const div = document.createElement('div');
                div.className = 'project-item';
                div.dataset.id = data.id;
                div.innerHTML = `<h3>${title}</h3><p>${description}</p><a href="${url}">رابط المشروع</a>`;
                list.prepend(div);
                this.reset();
            } else {
                alert('خطأ أثناء إنشاء المشروع');
            }
        });

        document.getElementById('projectsList').addEventListener('click', async function(e){
            if (e.target.matches('.btn-delete')) {
                const id = e.target.dataset.id;
                if (!confirm('هل تريد حذف المشروع؟')) return;
                const res = await fetch('/api/projects/' + id, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': csrf } });
                if (res.ok) {
                    e.target.closest('.project-item').remove();
                } else alert('فشل الحذف');
            }
        });
    </script>
</body>
</html>
