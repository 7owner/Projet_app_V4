import { startStimulusApp } from '@symfony/stimulus-bridge';
import ChartController from './controllers/chart_controller.js';

const app = startStimulusApp();
app.register('chart', ChartController);
