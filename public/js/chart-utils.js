function findLocalMinMax(data, windowSize) {
    const localMinMax = [];
    for (let i = 0; i < data.length; i += windowSize) {
        const windowData = data.slice(i, i + windowSize);
        const min = Math.min(...windowData);
        const max = Math.max(...windowData);
        localMinMax.push({ min, max, minIndex: i + windowData.indexOf(min), maxIndex: i + windowData.indexOf(max) });
    }
    return localMinMax;
}

function updateInfoBox(chartId, globalMax, globalMin, localMax, localMin) {
    document.getElementById(`globalMax${chartId}`).textContent = `(X: ${globalMax.x}, Y: ${globalMax.y.toFixed(2)})`;
    document.getElementById(`globalMin${chartId}`).textContent = `(X: ${globalMin.x}, Y: ${globalMin.y.toFixed(2)})`;
    document.getElementById(`currentLocalMax${chartId}`).textContent = `(X: ${localMax.x}, Y: ${localMax.y.toFixed(2)})`;
    document.getElementById(`currentLocalMin${chartId}`).textContent = `(X: ${localMin.x}, Y: ${localMin.y.toFixed(2)})`;
}

// Function to show local minima and maxima
function showLocalMinMax(chart, data, chartId) {
    const localMin = localMinMax[localMinIndex]?.min ?? null;
    const localMax = localMinMax[localMinIndex]?.max ?? null;
    const localMinIndexValue = localMinMax[localMinIndex]?.minIndex ?? null;
    const localMaxIndexValue = localMinMax[localMinIndex]?.maxIndex ?? null;

    const localMinDataset = chart.data.datasets.find(dataset => dataset.label === 'Local Min');
    const localMaxDataset = chart.data.datasets.find(dataset => dataset.label === 'Local Max');

    if (localMinDataset) {
        localMinDataset.data = [{ x: localMinIndexValue, y: localMin }];
    }
    if (localMaxDataset) {
        localMaxDataset.data = [{ x: localMaxIndexValue, y: localMax }];
    }

    updateInfoBox(chartId, { x: data.indexOf(getMax(data)), y: getMax(data) }, { x: data.indexOf(getMin(data)), y: getMin(data) }, { x: localMaxIndexValue, y: localMax }, { x: localMinIndexValue, y: localMin });

    chart.update();
}


function markMultiples(chart, data, value) {
    const multiplesData = data.map((v, i) => {
        if (v % value === 0) {
            return { x: i, y: v };
        }
        return null;
    }).filter(item => item);

    const multiplesDataset = {
        label: `Multiples of ${value}`,
        data: multiplesData,
        pointBackgroundColor: 'purple',
        pointBorderColor: 'purple',
        pointRadius: 8,
        type: 'scatter'
    };

    chart.data.datasets = chart.data.datasets.filter(dataset => !dataset.label.includes('Multiples of'));
    chart.data.datasets.push(multiplesDataset);
    chart.update();
}

function deleteMultiples(chart, data, value) {
    const threshold = Math.floor(data.length * 0.1);
    const indicesToDelete = [];

    data.forEach((v, i) => {
        if (v % value === 0) {
            for (let j = Math.max(i - threshold, 0); j <= Math.min(i + threshold, data.length - 1); j++) {
                indicesToDelete.push(j);
            }
        }
    });

    chart.data.datasets.forEach((dataset) => {
        if (dataset.label.includes('Time Domain') || dataset.label.includes('Frequency Domain')) {
            indicesToDelete.forEach((index) => {
                dataset.data[index] = null;
            });
        }
    });
    chart.update();
}

function fft(data) {
    const N = data.length;
    const fft = new Array(N).fill(0).map(() => [0, 0]);
    for (let k = 0; k < N; k++) {
        for (let n = 0; n < N; n++) {
            const realPart = Math.cos((2 * Math.PI * k * n) / N) * data[n];
            const imagPart = -Math.sin((2 * Math.PI * k * n) / N) * data[n];
            fft[k][0] += realPart;
            fft[k][1] += imagPart;
        }
        fft[k] = Math.sqrt(fft[k][0] ** 2 + fft[k][1] ** 2);
    }
    return fft;
}
