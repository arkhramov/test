const API_BASE = 'http://localhost:8000/api';
const isIndex = location.pathname.includes('index.html') || location.pathname.endsWith('/');
const isSlot = location.pathname.includes('slot.html');

if (isIndex) {
    fetch(`${API_BASE}/slots`)
        .then(res => res.json())
        .then(slots => {
            const container = document.getElementById('slotsContainer');
            const filter = document.getElementById('providerFilter');
            const providers = [...new Set(slots.map(s => s.provider))];

            providers.forEach(provider => {
                const option = document.createElement('option');
                option.value = provider;
                option.textContent = provider;
                filter.appendChild(option);
            });

            const render = (filtered) => {
                container.innerHTML = '';
                filtered.forEach(slot => {
                    const div = document.createElement('div');
                    div.className = 'col-md-4';
                    div.innerHTML = `
            <div class="card h-100 shadow-sm">
              <img src="${slot.image_url}" class="card-img-top" alt="${slot.title}" />
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">${slot.title}</h5>
                <p class="card-text text-muted mb-3">${slot.provider}</p>
                <button class="btn btn-primary mt-auto" onclick="openSlot(${slot.id})">Open</button>
              </div>
            </div>
          `;
                    container.appendChild(div);
                });
            };

            render(slots);

            filter.addEventListener('change', () => {
                const value = filter.value;
                render(value ? slots.filter(s => s.provider === value) : slots);
            });
        });

    window.openSlot = (id) => {
        fetch(`${API_BASE}/bonus/${id}`, { method: 'POST' })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                window.location.href = `slot.html?id=${id}`;
            });
    };
}

if (isSlot) {
    const params = new URLSearchParams(location.search);
    const id = params.get('id');

    fetch(`${API_BASE}/slot/${id}`)
        .then(res => res.json())
        .then(slot => {
            document.getElementById('slotTitle').textContent = slot.title;
            document.getElementById('slotProvider').textContent = slot.provider;
            document.getElementById('slotDescription').textContent = slot.description;
            document.getElementById('slotImage').src = slot.image_url;
        });
}
