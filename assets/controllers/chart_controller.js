import { Controller } from '@hotwired/stimulus';
import { Chart } from 'chart.js';

/* stimulus controllers can be created with `./bin/console make:stimulus` */
export default class extends Controller {
    static values = {
        labels: Array,
        data: Array,
    };

    connect() {
        this.renderChart();
    }

    disconnect() {
        if (this.chart) {
            this.chart.destroy();
        }
    }

    renderChart() {
        if (this.chart) {
            this.chart.destroy(); // Destroy existing chart before re-rendering
        }

        const ctx = this.element.getContext('2d');

        this.chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: this.labelsValue,
                datasets: [{
                    label: 'Nombre de maintenances',
                    data: this.dataValue,
                    backgroundColor: 'rgba(108, 99, 255, 0.6)',
                    borderColor: 'rgba(108, 99, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre de maintenances'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Mois'
                        }
                    }
                }
            }
        });
    }
}
