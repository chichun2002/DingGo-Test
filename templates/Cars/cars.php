<?php if ($isEmpty): ?>
    <div class="empty">No cars found.</div>
<?php else: ?>
    <div>
        <?php foreach ($cars as $car): ?>
            <div class="car">
                <div class="title">
                    <div class="plate"><?= h($car->license_plate) ?> (<?= h($car->license_state) ?>)</div>
                    <div class="model"><?= h($car->year) ?> <?= h($car->make) ?> <?= h($car->model) ?></div>
                    <div class="colour"><?= h($car->colour) ?></div>
                </div>
                <div class="details">
                    <div class="vin">VIN: <?= h($car->vin) ?></div>
                </div>
                <div class="quotes">
                    <?php
                        $car_quotes = $quotes->filter(fn ($quote) => $quote->car_id === $car->id)->sortBy('price', SORT_ASC);
                        foreach ($car_quotes as $quote): 
                    ?>
                            <div class="quote">
                                <div class="quote-title">
                                    <div class="repairer"><?= h($quote->repairer) ?></div>
                                    <div class="price"><?= h($this->Number->currency($quote->price, 'AUD')) ?></div>
                                </div>
                                <div class="quote-details">
                                    <div class="description"><?= h($quote->overview_of_work) ?></div>
                                </div>
                            </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>