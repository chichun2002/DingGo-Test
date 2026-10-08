<?php $this->Html->css('cars', ['block' => true]); ?>

<div class="container">
    <div id="cars" class="container">
        <div class="loading">Loading...</div>
    </div>
</div>

<script>
fetch(<?= json_encode($this->Url->build(['controller' => 'Cars', 'action' => 'cars'])) ?>)
    .then(response => {
        if (!response.ok) {
            throw new Error('HTTP ' + response.status);
        }
        return response.text();
    })
    .then(html => {
        document.getElementById('cars').innerHTML = html;
    })
    .catch(() => {
        document.getElementById('cars').innerHTML = '<div class="error">Error loading cars.</div>';
    });
</script>

