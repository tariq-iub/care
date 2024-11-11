@extends('layouts.care')

@section('content')
<div class="container">
    <div class="text-center mb-3">
        <h1>Frequency Domain Combined Plots</h1>
        <!-- Adjusted Button Sizes -->
        <button id="goBack" class="btn btn-sm btn-secondary mx-1 btn-small">Go Back</button>
        <button id="markMultiplesBtn" class="btn btn-sm btn-primary mx-1 btn-small">Mark Multiples</button>
        <button id="deleteMultiplesBtn" class="btn btn-sm btn-danger mx-1 btn-small" disabled>Delete Multiples</button>
        <button id="setSidebandBtn" class="btn btn-sm btn-primary mx-1 btn-small">Set Sideband</button>
        <button id="undoSidebandBtn" class="btn btn-sm btn-primary mx-1 btn-small" disabled>Undo Sideband</button>

        <!-- Input Boxes for f1, f2, and delta f -->
        <div class="d-inline-block">
            <input type="text" id="f1Input" class="form-control form-control-sm mx-1 d-inline" placeholder="f1" style="width: 70px;" />
            <input type="text" id="f2Input" class="form-control form-control-sm mx-1 d-inline" placeholder="f2" style="width: 70px;" />
            <input type="text" id="deltaFInput" class="form-control form-control-sm mx-1 d-inline" placeholder="delta f" style="width: 70px;" />
        </div>

        <!-- New Find OVL Button -->
        <button id="findOVLBtn" class="btn btn-sm btn-primary mx-1 btn-small">Find OVL</button>
    </div>

    <!-- Row for Graph X -->
    <div class="row no-gutters align-items-start" style="margin-bottom: 0;">
        <!-- Sidebar for Graph X values -->
        <div class="col-3" style="padding-right: 0;">
            <div id="valueDisplayX">
                <!-- Values for Graph X will be inserted here -->
            </div>
        </div>
        <!-- Plot for Graph X -->
        <div class="col-9" style="padding-left: 0;">
            <div id="plotX"></div>
        </div>
    </div>

    <!-- Row for Graph Y -->
    <div class="row no-gutters align-items-start" style="margin-bottom: 0;">
        <!-- Sidebar for Graph Y values -->
        <div class="col-3" style="padding-right: 0;">
            <div id="valueDisplayY">
                <!-- Values for Graph Y will be inserted here -->
            </div>
        </div>
        <!-- Plot for Graph Y -->
        <div class="col-9" style="padding-left: 0;">
            <div id="plotY"></div>
        </div>
    </div>

    <!-- Row for Graph Z -->
    <div class="row no-gutters align-items-start">
        <!-- Sidebar for Graph Z values -->
        <div class="col-3" style="padding-right: 0;">
            <div id="valueDisplayZ">
                <!-- Values for Graph Z will be inserted here -->
            </div>
        </div>
        <!-- Plot for Graph Z -->
        <div class="col-9" style="padding-left: 0;">
            <div id="plotZ"></div>
        </div>
    </div>
</div>

<!-- Include CSS styles within this blade -->
<style>
    /* Ensure that plots are stretched horizontally and aligned vertically without any spacing */
    #plotX, #plotY, #plotZ {
        width: 100%;
        height: 200px;
        margin: 0;
        padding: 0;
    }
    /* Remove spacing between plots */
    #plotX {
        margin-bottom: -5px;
    }
    #plotY {
        margin-bottom: -5px;
    }
    /* Adjust value displays */
    #valueDisplayX, #valueDisplayY, #valueDisplayZ {
        font-family: Arial, sans-serif;
        font-size: 14px;
        margin: 0;
        padding: 0;
        line-height: 1.4;
        margin-top: 50px;
    }

    /* Remove default margins from headings */
    #valueDisplayX h3, #valueDisplayY h3, #valueDisplayZ h3 {
        font-size: 16px;
        margin: 0;
        padding: 0;
    }

    /* Remove default margins and padding from lists */
    #valueDisplayX ul, #valueDisplayY ul, #valueDisplayZ ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    /* Remove margin from list items */
    #valueDisplayX li, #valueDisplayY li, #valueDisplayZ li {
        margin: 0;
        padding: 0;
    }

    /* Adjust the alignment of the rows */
    .align-items-start {
        align-items: flex-start;
    }

    /* Ensure no spacing between columns */
    .no-gutters > [class^='col-'] {
        padding-right: 0;
        padding-left: 0;
    }

    /* Adjust the width of the value display columns */
    .col-3 {
        max-width: 180px;
    }

    /* Style the buttons */
    .btn-small {
        font-size: 12px;
        padding: 5px 10px;
    }

    /* Style input boxes */
    .form-control-sm {
        font-size: 12px;
        text-align: center;
    }
</style>

<!-- Include Plotly.js -->
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<!-- Include JavaScript file -->
<!-- <script src="{{ asset('js/timedomain.js') }}"></script> -->

<!-- Pass data to JavaScript -->
<script>
    var valuesX = @json($sensorData->pluck('X'));
    var valuesY = @json($sensorData->pluck('Y'));
    var valuesZ = @json($sensorData->pluck('Z'));

    valuesX = fft(valuesX);
    valuesY = fft(valuesY);
    valuesZ = fft(valuesZ);
    // Ensure that valuesX, valuesY, valuesZ are available
// Ensure that valuesX, valuesY, valuesZ are available
var indices = Array.from(Array(valuesX.length).keys());
var plotX = document.getElementById('plotX');
var plotY = document.getElementById('plotY');
var plotZ = document.getElementById('plotZ');

// Create traces
var traceX = {
    x: indices,
    y: valuesX,
    mode: 'lines',
    name: 'X',
    line: { color: 'blue' },
    hovertemplate: 'X: %{x}<br>Y: %{y}<extra></extra>' // Custom hover template
};
var traceY = {
    x: indices,
    y: valuesY,
    mode: 'lines',
    name: 'Y',
    line: { color: 'green' },
    hovertemplate: 'X: %{x}<br>Y: %{y}<extra></extra>' // Custom hover template
};

var traceZ = {
    x: indices,
    y: valuesZ,
    mode: 'lines',
    name: 'Z',
    line: { color: 'red' },
    hovertemplate: 'X: %{x}<br>Y: %{y}<extra></extra>' // Custom hover template
};

// Common layout
var commonLayout = {
    margin: { l: 50, r: 50, t: 0, b: 0 },
    xaxis: {
        range: [0, valuesX.length - 1],
        zeroline: false,
        showgrid: false,
        showticklabels: false
    },
    yaxis: {
        title: '', // Will be set individually
        autorange: true
    },
    showlegend: true
};

// Create individual layouts
var layoutX = JSON.parse(JSON.stringify(commonLayout));
layoutX.yaxis.title = 'X Value';
layoutX.margin.b = 0; // Remove bottom margin
layoutX.xaxis.showticklabels = false; // Hide x-axis labels

var layoutY = JSON.parse(JSON.stringify(commonLayout));
layoutY.yaxis.title = 'Y Value';
layoutY.margin.t = 0; // Remove top margin
layoutY.margin.b = 0; // Remove bottom margin
layoutY.xaxis.showticklabels = false; // Hide x-axis labels

var layoutZ = JSON.parse(JSON.stringify(commonLayout));
layoutZ.yaxis.title = 'Z Value';
layoutZ.margin.t = 0; // Remove top margin
layoutZ.xaxis.showticklabels = true; // Show x-axis labels on the bottom plot

// Compute global minima and maxima for X
var globalMinX = Math.min(...valuesX);
var globalMaxX = Math.max(...valuesX);
var globalMinIndexX = valuesX.indexOf(globalMinX);
var globalMaxIndexX = valuesX.indexOf(globalMaxX);

// Markers for global minima and maxima for X
var globalMinMarkerX = {
    x: [globalMinIndexX],
    y: [globalMinX],
    mode: 'markers',
    name: 'Global Min',
    marker: { color: 'purple', symbol: 'square', size: 10 }
};

var globalMaxMarkerX = {
    x: [globalMaxIndexX],
    y: [globalMaxX],
    mode: 'markers',
    name: 'Global Max',
    marker: { color: 'orange', symbol: 'square', size: 10 }
};

// Repeat for Y
var globalMinY = Math.min(...valuesY);
var globalMaxY = Math.max(...valuesY);
var globalMinIndexY = valuesY.indexOf(globalMinY);
var globalMaxIndexY = valuesY.indexOf(globalMaxY);

var globalMinMarkerY = {
    x: [globalMinIndexY],
    y: [globalMinY],
    mode: 'markers',
    name: 'Global Min',
    marker: { color: 'purple', symbol: 'square', size: 10 }
};

var globalMaxMarkerY = {
    x: [globalMaxIndexY],
    y: [globalMaxY],
    mode: 'markers',
    name: 'Global Max',
    marker: { color: 'orange', symbol: 'square', size: 10 }
};

// Repeat for Z
var globalMinZ = Math.min(...valuesZ);
var globalMaxZ = Math.max(...valuesZ);
var globalMinIndexZ = valuesZ.indexOf(globalMinZ);
var globalMaxIndexZ = valuesZ.indexOf(globalMaxZ);

var globalMinMarkerZ = {
    x: [globalMinIndexZ],
    y: [globalMinZ],
    mode: 'markers',
    name: 'Global Min',
    marker: { color: 'purple', symbol: 'square', size: 10 }
};

var globalMaxMarkerZ = {
    x: [globalMaxIndexZ],
    y: [globalMaxZ],
    mode: 'markers',
    name: 'Global Max',
    marker: { color: 'orange', symbol: 'square', size: 10 }
};

// For plotX
var localMinMarkerX = {
    x: [],
    y: [],
    mode: 'markers',
    name: 'Local Min',
    marker: { color: 'cyan', symbol: 'square', size: 10 }
};
var localMaxMarkerX = {
    x: [],
    y: [],
    mode: 'markers',
    name: 'Local Max',
    marker: { color: 'magenta', symbol: 'square', size: 10 }
};

// For plotY
var localMinMarkerY = {
    x: [],
    y: [],
    mode: 'markers',
    name: 'Local Min',
    marker: { color: 'cyan', symbol: 'square', size: 10 }
};
var localMaxMarkerY = {
    x: [],
    y: [],
    mode: 'markers',
    name: 'Local Max',
    marker: { color: 'magenta', symbol: 'square', size: 10 }
};

// For plotZ
var localMinMarkerZ = {
    x: [],
    y: [],
    mode: 'markers',
    name: 'Local Min',
    marker: { color: 'cyan', symbol: 'square', size: 10 }
};

var localMaxMarkerZ = {
    x: [],
    y: [],
    mode: 'markers',
    name: 'Local Max',
    marker: { color: 'magenta', symbol: 'square', size: 10 }
};

// Initialize empty traces for locked value markers
var lockedMarkerX = {
    x: [],
    y: [],
    mode: 'markers',
    name: 'Locked Value',
    marker: { color: 'black', symbol: 'circle', size: 15 }
};

var lockedMarkerY = {
    x: [],
    y: [],
    mode: 'markers',
    name: 'Locked Value',
    marker: { color: 'black', symbol: 'circle', size: 15 }
};

var lockedMarkerZ = {
    x: [],
    y: [],
    mode: 'markers',
    name: 'Locked Value',
    marker: { color: 'black', symbol: 'circle', size: 15 }
};


var dataX = [traceX, globalMinMarkerX, globalMaxMarkerX, localMinMarkerX, localMaxMarkerX, lockedMarkerX];
var dataY = [traceY, globalMinMarkerY, globalMaxMarkerY, localMinMarkerY, localMaxMarkerY, lockedMarkerY];
var dataZ = [traceZ, globalMinMarkerZ, globalMaxMarkerZ, localMinMarkerZ, localMaxMarkerZ, lockedMarkerZ];



// Draw plots
Plotly.newPlot('plotX', dataX, layoutX);
Plotly.newPlot('plotY', dataY, layoutY);
Plotly.newPlot('plotZ', dataZ, layoutZ);




 // Initial annotations
 var initialExtremaX = { minIndex: globalMinIndexX, minValue: globalMinX, maxIndex: globalMaxIndexX, maxValue: globalMaxX };
    var initialExtremaY = { minIndex: globalMinIndexY, minValue: globalMinY, maxIndex: globalMaxIndexY, maxValue: globalMaxY };
    var initialExtremaZ = { minIndex: globalMinIndexZ, minValue: globalMinZ, maxIndex: globalMaxIndexZ, maxValue: globalMaxZ };

    // updateAnnotations(initialExtremaX, initialExtremaY, initialExtremaZ);

// Initial locked values (could be set to undefined or any default value)
var lockedValueX = 0;
var lockedValueY = 0;
var lockedValueZ = 0;

// Locked indices and values for each axis
var currentLockIndexX = 0;
var currentLockIndexY = 0;
var currentLockIndexZ = 0;

// Update the displayed values initially
updateDisplayedValues(initialExtremaX, initialExtremaY, initialExtremaZ, lockedValueX, lockedValueY, lockedValueZ);


// Synchronize zoom and pan
var isUpdating = false;

function syncGraphs(sourcePlot, xRange) {
    if (isUpdating) return;
    isUpdating = true;
    var update = {
        'xaxis.range': xRange
    };
    [plotX, plotY, plotZ].forEach(function(plot) {
        if (plot !== sourcePlot) {
            Plotly.relayout(plot, update);
        }
    });
    isUpdating = false;
}

[plotX, plotY, plotZ].forEach(function(plot) {
    plot.on('plotly_relayout', function(eventdata) {
        if (eventdata['xaxis.range[0]'] && eventdata['xaxis.range[1]']) {
            var xRange = [eventdata['xaxis.range[0]'], eventdata['xaxis.range[1]']];
            syncGraphs(plot, xRange);
        }
    });
});

// Function to update vertical lines
function updateVerticalLines(xValue) {
    var update = {
        shapes: [{
            type: 'line',
            x0: xValue,
            x1: xValue,
            y0: 0,
            y1: 1,
            yref: 'paper',
            line: {
                color: 'black',
                width: 1,
                dash: 'dot'
            }
        }]
    };
    Plotly.relayout(plotX, update);
    Plotly.relayout(plotY, update);
    Plotly.relayout(plotZ, update);
}

// Function to remove vertical lines
function removeVerticalLines() {
    var update = {
        shapes: []
    };
    Plotly.relayout(plotX, update);
    Plotly.relayout(plotY, update);
    Plotly.relayout(plotZ, update);
}

//handle left click
[plotX, plotY, plotZ].forEach(function(plot) {
    plot.on('plotly_click', function(data) {
        if (data.event.button === 0) { // Left-click
            var xValue = data.points[0].x;
            handleLeftClick(xValue);
        }
    });
});

// Function to get xValue from mouse event
function getXValueFromEvent(event, plot) {
    var xaxis = plot._fullLayout.xaxis;
    var bbox = plot.getBoundingClientRect();
    var xPosition = event.clientX - bbox.left;
    var xValue = xaxis.p2d(xPosition - xaxis._offset);
    return xValue;
}

// Add mousemove and mouseout event listeners to synchronize vertical lines
[plotX, plotY, plotZ].forEach(function(plot) {
    plot.addEventListener('mousemove', function(event) {
        var xValue = getXValueFromEvent(event, plot);
        updateVerticalLines(xValue);
    });
    plot.addEventListener('mouseout', function(event) {
        removeVerticalLines();
    });
});

var currentLockIndex = null;

 // Functions: handleLeftClick, findLocalExtrema, updateLocalExtremaMarkers, updateAnnotations (as defined above)
 function handleLeftClick(xValue) {
    var index = Math.round(xValue);
    index = Math.max(0, Math.min(index, valuesX.length - 1));
    
    // For each data array, find the local maxima near the clicked index
    var lockResultX = findLocalMaxima(valuesX, index);
    var lockResultY = findLocalMaxima(valuesY, index);
    var lockResultZ = findLocalMaxima(valuesZ, index);

    // Update the locked indices and values for each axis
    currentLockIndexX = lockResultX.index;
    currentLockIndexY = lockResultY.index;
    currentLockIndexZ = lockResultZ.index;

    lockedValueX = lockResultX.value;
    lockedValueY = lockResultY.value;
    lockedValueZ = lockResultZ.value;

    // For each dataset, find local min and max around the locked index
    var localExtremaX = findLocalExtrema(valuesX, currentLockIndexX);
    var localExtremaY = findLocalExtrema(valuesY, currentLockIndexY);
    var localExtremaZ = findLocalExtrema(valuesZ, currentLockIndexZ);

    // Update the lock markers
    updateLockMarkers();

    // Update the plots with the new markers
    updateLocalExtremaMarkers(localExtremaX, localExtremaY, localExtremaZ);

    // Update the displayed values on the left side
    updateDisplayedValues(localExtremaX, localExtremaY, localExtremaZ, lockedValueX, lockedValueY, lockedValueZ);

    // If Mark Multiples is active, update the multiples markers
    if (markMultiplesActive) {
        // First remove existing multiples markers
        removeMultiplesMarkers();
        // Then mark new multiples
        markMultiplesOnAllPlots();
    }
}


function findLocalMaxima(data, index) {
    var range = 30; // Define the range to search around the index
    var start = Math.max(0, index - range);
    var end = Math.min(data.length - 1, index + range);

    var maxVal = -Infinity;
    var maxIndex = index;

    for (var i = start; i <= end; i++) {
        // Check if data[i] is a local maxima
        if ((i === 0 || data[i] > data[i - 1]) &&
            (i === data.length - 1 || data[i] > data[i + 1]) &&
            data[i] > maxVal) {
            maxVal = data[i];
            maxIndex = i;
        }
    }

    // If no local maxima found in the range, use the value at the clicked index
    if (maxVal === -Infinity) {
        maxVal = data[index];
        maxIndex = index;
    }

    return { index: maxIndex, value: maxVal };
}



function findLocalExtrema(values, index) {
    const sliceSize = 100;

    // Determine the start and end indices of the slice
    let start = Math.max(0, index - Math.floor(sliceSize / 2));
    let end = Math.min(values.length, start + sliceSize);

    // Adjust start if we're near the end of the array
    if (end - start < sliceSize) {
        start = Math.max(0, end - sliceSize);
    }

    // Extract the sliced data
    const slicedData = values.slice(start, end);

    // Find the minimum and maximum values in the sliced data
    const minValue = Math.min(...slicedData);
    const maxValue = Math.max(...slicedData);

    // Find the indices of the min and max within the sliced data
    const minIndexInSlice = slicedData.indexOf(minValue);
    const maxIndexInSlice = slicedData.indexOf(maxValue);

    // Convert the indices back to the original array indices
    const minIndex = start + minIndexInSlice;
    const maxIndex = start + maxIndexInSlice;

    return {
        minIndex: minIndex,
        minValue: minValue,
        maxIndex: maxIndex,
        maxValue: maxValue
    };
}


function updateLocalExtremaMarkers(extremaX, extremaY, extremaZ) {
    // Update local extrema markers for X
    Plotly.restyle(plotX, {
        'x': [[extremaX.minIndex]],
        'y': [[extremaX.minValue]]
    }, [3]); // Index 3 is for localMinMarkerX

    Plotly.restyle(plotX, {
        'x': [[extremaX.maxIndex]],
        'y': [[extremaX.maxValue]]
    }, [4]); // Index 4 is for localMaxMarkerX

    // Update local extrema markers for Y
    Plotly.restyle(plotY, {
        'x': [[extremaY.minIndex]],
        'y': [[extremaY.minValue]]
    }, [3]); // Index 3 is for localMinMarkerY

    Plotly.restyle(plotY, {
        'x': [[extremaY.maxIndex]],
        'y': [[extremaY.maxValue]]
    }, [4]); // Index 4 is for localMaxMarkerY

    // Update local extrema markers for Z
    Plotly.restyle(plotZ, {
        'x': [[extremaZ.minIndex]],
        'y': [[extremaZ.minValue]]
    }, [3]); // Index 3 is for localMinMarkerZ

    Plotly.restyle(plotZ, {
        'x': [[extremaZ.maxIndex]],
        'y': [[extremaZ.maxValue]]
    }, [4]); // Index 4 is for localMaxMarkerZ
}

function updateLockMarkers() {
    // Update lock marker for X
    Plotly.restyle(plotX, {
        'x': [[currentLockIndexX]],
        'y': [[lockedValueX]]
    }, [5]); // Index 5 is for lockedMarkerX

    // Update lock marker for Y
    Plotly.restyle(plotY, {
        'x': [[currentLockIndexY]],
        'y': [[lockedValueY]]
    }, [5]); // Index 5 is for lockedMarkerY

    // Update lock marker for Z
    Plotly.restyle(plotZ, {
        'x': [[currentLockIndexZ]],
        'y': [[lockedValueZ]]
    }, [5]); // Index 5 is for lockedMarkerZ
}


// function updateAnnotations(extremaX, extremaY, extremaZ) {
//     // Update annotations for plotX
//     var annotationsX = [
//         {
//             x: globalMinIndexX,
//             y: globalMinX,
//             xref: 'x',
//             yref: 'y',
//             text: `Global Min: ${globalMinX.toFixed(2)}`,
//             showarrow: true,
//             arrowhead: 7,
//             ax: -40,
//             ay: -40
//         },
//         {
//             x: globalMaxIndexX,
//             y: globalMaxX,
//             xref: 'x',
//             yref: 'y',
//             text: `Global Max: ${globalMaxX.toFixed(2)}`,
//             showarrow: true,
//             arrowhead: 7,
//             ax: 40,
//             ay: -40
//         },
//         {
//             x: extremaX.minIndex,
//             y: extremaX.minValue,
//             xref: 'x',
//             yref: 'y',
//             text: `Local Min: ${extremaX.minValue.toFixed(2)}`,
//             showarrow: true,
//             arrowhead: 7,
//             ax: -40,
//             ay: 40
//         },
//         {
//             x: extremaX.maxIndex,
//             y: extremaX.maxValue,
//             xref: 'x',
//             yref: 'y',
//             text: `Local Max: ${extremaX.maxValue.toFixed(2)}`,
//             showarrow: true,
//             arrowhead: 7,
//             ax: 40,
//             ay: 40
//         }
//     ];

//     Plotly.relayout(plotX, { annotations: annotationsX });

//     // Repeat for plotY
//     var annotationsY = [
//         {
//             x: globalMinIndexY,
//             y: globalMinY,
//             xref: 'x',
//             yref: 'y',
//             text: `Global Min: ${globalMinY.toFixed(2)}`,
//             showarrow: true,
//             arrowhead: 7,
//             ax: -40,
//             ay: -40
//         },
//         {
//             x: globalMaxIndexY,
//             y: globalMaxY,
//             xref: 'x',
//             yref: 'y',
//             text: `Global Max: ${globalMaxY.toFixed(2)}`,
//             showarrow: true,
//             arrowhead: 7,
//             ax: 40,
//             ay: -40
//         },
//         {
//             x: extremaY.minIndex,
//             y: extremaY.minValue,
//             xref: 'x',
//             yref: 'y',
//             text: `Local Min: ${extremaY.minValue.toFixed(2)}`,
//             showarrow: true,
//             arrowhead: 7,
//             ax: -40,
//             ay: 40
//         },
//         {
//             x: extremaY.maxIndex,
//             y: extremaY.maxValue,
//             xref: 'x',
//             yref: 'y',
//             text: `Local Max: ${extremaY.maxValue.toFixed(2)}`,
//             showarrow: true,
//             arrowhead: 7,
//             ax: 40,
//             ay: 40
//         }
//     ];

//     Plotly.relayout(plotY, { annotations: annotationsY });

//     // Repeat for plotZ
//     var annotationsZ = [
//         {
//             x: globalMinIndexZ,
//             y: globalMinZ,
//             xref: 'x',
//             yref: 'y',
//             text: `Global Min: ${globalMinZ.toFixed(2)}`,
//             showarrow: true,
//             arrowhead: 7,
//             ax: -40,
//             ay: -40
//         },
//         {
//             x: globalMaxIndexZ,
//             y: globalMaxZ,
//             xref: 'x',
//             yref: 'y',
//             text: `Global Max: ${globalMaxZ.toFixed(2)}`,
//             showarrow: true,
//             arrowhead: 7,
//             ax: 40,
//             ay: -40
//         },
//         {
//             x: extremaZ.minIndex,
//             y: extremaZ.minValue,
//             xref: 'x',
//             yref: 'y',
//             text: `Local Min: ${extremaZ.minValue.toFixed(2)}`,
//             showarrow: true,
//             arrowhead: 7,
//             ax: -40,
//             ay: 40
//         },
//         {
//             x: extremaZ.maxIndex,
//             y: extremaZ.maxValue,
//             xref: 'x',
//             yref: 'y',
//             text: `Local Max: ${extremaZ.maxValue.toFixed(2)}`,
//             showarrow: true,
//             arrowhead: 7,
//             ax: 40,
//             ay: 40
//         }
//     ];

//     Plotly.relayout(plotZ, { annotations: annotationsZ });
// }

function updateDisplayedValues(extremaX, extremaY, extremaZ, lockedValueX, lockedValueY, lockedValueZ) {
    console.log('Updating displayed values...');
    console.log('Extrema X:', extremaX);
    console.log('Locked Value X:', lockedValueX);

    // Format values using the helper function
    const formattedGlobalMinX = formatValue(globalMinX);
    const formattedGlobalMaxX = formatValue(globalMaxX);
    const formattedLocalMinX = formatValue(extremaX.minValue);
    const formattedLocalMaxX = formatValue(extremaX.maxValue);
    const formattedLockedValueX = formatValue(lockedValueX);

    const formattedGlobalMinY = formatValue(globalMinY);
    const formattedGlobalMaxY = formatValue(globalMaxY);
    const formattedLocalMinY = formatValue(extremaY.minValue);
    const formattedLocalMaxY = formatValue(extremaY.maxValue);
    const formattedLockedValueY = formatValue(lockedValueY);

    const formattedGlobalMinZ = formatValue(globalMinZ);
    const formattedGlobalMaxZ = formatValue(globalMaxZ);
    const formattedLocalMinZ = formatValue(extremaZ.minValue);
    const formattedLocalMaxZ = formatValue(extremaZ.maxValue);
    const formattedLockedValueZ = formatValue(lockedValueZ);

    const formattedLockedIndexX = formatValue(currentLockIndexX);
    const formattedLockedIndexY = formatValue(currentLockIndexY);
    const formattedLockedIndexZ = formatValue(currentLockIndexZ);

    // Format OVL values
    const formattedOVLX = formatValue(ovlX);
    const formattedOVLY = formatValue(ovlY);
    const formattedOVLZ = formatValue(ovlZ);

    // Format f1, f2, deltaF
    const formattedF1 = Number.isFinite(f1) ? f1 : 'N/A';
    const formattedF2 = Number.isFinite(f2) ? f2 : 'N/A';
    const formattedDeltaF = Number.isFinite(deltaF) ? deltaF : 'N/A';

    // Update content for Graph X
    var valueDisplayX = document.getElementById('valueDisplayX');
    var contentX = `
        <h3>Graph X Values</h3>
        <ul>
            <li>Global Min: ${formattedGlobalMinX}</li>
            <li>Global Max: ${formattedGlobalMaxX}</li>
            <li>Local Min: ${formattedLocalMinX}</li>
            <li>Local Max: ${formattedLocalMaxX}</li>
            <li>Locked Value (Y): ${formattedLockedValueX}</li>
            <li>Locked Value (X): ${formattedLockedIndexX}</li>
            <li>f1: ${formattedF1}</li>
            <li>f2: ${formattedF2}</li>
            <li>delta f: ${formattedDeltaF}</li>
            <li>OVL: ${formattedOVLX}</li>
        </ul>
    `;
    valueDisplayX.innerHTML = contentX;

    // Update content for Graph Y
    var valueDisplayY = document.getElementById('valueDisplayY');
    var contentY = `
        <h3>Graph Y Values</h3>
        <ul>
            <li>Global Min: ${formattedGlobalMinY}</li>
            <li>Global Max: ${formattedGlobalMaxY}</li>
            <li>Local Min: ${formattedLocalMinY}</li>
            <li>Local Max: ${formattedLocalMaxY}</li>
            <li>Locked Value (Y): ${formattedLockedValueY}</li>
            <li>Locked Value (X): ${formattedLockedIndexY}</li>
            <li>f1: ${formattedF1}</li>
            <li>f2: ${formattedF2}</li>
            <li>delta f: ${formattedDeltaF}</li>
            <li>OVL: ${formattedOVLY}</li>
        </ul>
    `;
    valueDisplayY.innerHTML = contentY;

    // Update content for Graph Z
    var valueDisplayZ = document.getElementById('valueDisplayZ');
    var contentZ = `
        <h3>Graph Z Values</h3>
        <ul>
            <li>Global Min: ${formattedGlobalMinZ}</li>
            <li>Global Max: ${formattedGlobalMaxZ}</li>
            <li>Local Min: ${formattedLocalMinZ}</li>
            <li>Local Max: ${formattedLocalMaxZ}</li>
            <li>Locked Value (Y): ${formattedLockedValueZ}</li>
            <li>Locked Value (X): ${formattedLockedIndexZ}</li>
            <li>f1: ${formattedF1}</li>
            <li>f2: ${formattedF2}</li>
            <li>delta f: ${formattedDeltaF}</li>
            <li>OVL: ${formattedOVLZ}</li>
        </ul>
    `;
    valueDisplayZ.innerHTML = contentZ;
}



function formatValue(value) {
    return Number.isFinite(value) ? value.toFixed(2) : 'N/A';
}

// Variable to track the state of the multiples marking
var markMultiplesActive = false;

// Add event listener to the button
document.getElementById('markMultiplesBtn').addEventListener('click', function() {
    markMultiplesActive = !markMultiplesActive;
    var deleteMultiplesBtn = document.getElementById('deleteMultiplesBtn');

    if (markMultiplesActive) {
        // Enable the Delete Multiples button
        deleteMultiplesBtn.disabled = false;

        // Change button text to indicate deactivation option
        this.textContent = 'Unmark Multiples';

        // Check if at least one locked index is set
        if ((currentLockIndexX === null || currentLockIndexX === undefined) &&
            (currentLockIndexY === null || currentLockIndexY === undefined) &&
            (currentLockIndexZ === null || currentLockIndexZ === undefined)) {
            alert('Please select a locked index first.');
            markMultiplesActive = false;
            this.textContent = 'Mark Multiples';
            deleteMultiplesBtn.disabled = true;
            return;
        }

        // Proceed to mark multiples
        markMultiplesOnAllPlots();
    } else {
        // Disable the Delete Multiples button
        deleteMultiplesBtn.disabled = true;

        // Change button text back
        this.textContent = 'Mark Multiples';

        // Remove multiples markers
        removeMultiplesMarkers();

        // Restore deleted data if any
        if (dataDeleted) {
            restoreDeletedData();
        }
    }
});




function markMultiplesOnAllPlots() {
    // For each plot, calculate and mark multiples
    markMultiples(plotX, currentLockIndexX, 'X');
    markMultiples(plotY, currentLockIndexY, 'Y');
    markMultiples(plotZ, currentLockIndexZ, 'Z');
}



function markMultiples(plot, lockIndex, axisLabel) {
    // Handle zero or negative locked index
    if (lockIndex === null || lockIndex === undefined || lockIndex <= 0) {
        alert(`Locked index for ${axisLabel} is zero or negative. Cannot mark multiples of zero or negative numbers.`);
        return;
    }

    const multiplesIndices = [];
    const multiplesValues = [];

    // Find multiples of the lockIndex within the range of indices
    for (let i = lockIndex; i < indices.length; i += lockIndex) {
        multiplesIndices.push(i);
        multiplesValues.push(plot.data[0].y[i]); // Assuming the main trace is at index 0
    }

    if (multiplesIndices.length === 0) {
        alert(`No multiples found for ${axisLabel} with base index ${lockIndex}.`);
        return;
    }

    // Create trace for multiples
    const multiplesMarker = {
        x: multiplesIndices,
        y: multiplesValues,
        mode: 'markers',
        name: `Multiples of Index ${lockIndex}`,
        marker: { color: 'purple', symbol: 'circle', size: 8 }
    };

    // Add the multiples marker trace to the plot
    Plotly.addTraces(plot, multiplesMarker);

    // Keep track of the multiples marker trace index for removal later
    if (!plot.multiplesTraceIndices) {
        plot.multiplesTraceIndices = [];
    }
    plot.multiplesTraceIndices.push(plot.data.length - 1); // The new trace is added at the end
}


function deleteMultiplesOnAllPlots() {
    // For each plot, delete multiples if lockedValue is set
    if (lockedValueX !== null && lockedValueX !== undefined) {
        deleteMultiples(plotX, valuesX, lockedValueX, 'X');
    }
    if (lockedValueY !== null && lockedValueY !== undefined) {
        deleteMultiples(plotY, valuesY, lockedValueY, 'Y');
    }
    if (lockedValueZ !== null && lockedValueZ !== undefined) {
        deleteMultiples(plotZ, valuesZ, lockedValueZ, 'Z');
    }

    // Update markers
    updateMarkersAfterDataChange();
}

function removeMultiplesMarkers() {
    removeMultiplesMarkersFromPlot(plotX);
    removeMultiplesMarkersFromPlot(plotY);
    removeMultiplesMarkersFromPlot(plotZ);
}

function removeMultiplesMarkersFromPlot(plot) {
    if (plot.multiplesTraceIndices && plot.multiplesTraceIndices.length > 0) {
        Plotly.deleteTraces(plot, plot.multiplesTraceIndices);
        // Reset the indices array
        plot.multiplesTraceIndices = [];
    }
}




//Deletion of Multiples ------------------------------------------------------------------>


var originalValuesX = [...valuesX];
var originalValuesY = [...valuesY];
var originalValuesZ = [...valuesZ];
var dataDeleted = false;


document.getElementById('markMultiplesBtn').addEventListener('click', function() {
    // markMultiplesActive = !markMultiplesActive;
    var deleteMultiplesBtn = document.getElementById('deleteMultiplesBtn');

    if (markMultiplesActive) {
        // Enable the Delete Multiples button
        deleteMultiplesBtn.disabled = false;

        // Change button text to indicate deactivation option
        this.textContent = 'Unmark Multiples';
        // Check if lockedValue is set
        if (lockedValueX === null || lockedValueY === null || lockedValueZ === null) {
            alert('Please left-click on a plot to select a locked value first.');
            markMultiplesActive = false;
            this.textContent = 'Mark Multiples';
            deleteMultiplesBtn.disabled = true;
            return;
        }
        // Proceed to mark multiples
        markMultiplesOnAllPlots();
    } else {
        // Disable the Delete Multiples button
        deleteMultiplesBtn.disabled = true;

        // Change button text back
        this.textContent = 'Mark Multiples';
        // Remove multiples markers
        removeMultiplesMarkers();
        // Restore deleted data if any
        if (dataDeleted) {
            restoreDeletedData();
        }
    }
});

document.getElementById('deleteMultiplesBtn').addEventListener('click', function() {
    if (!dataDeleted) {
        deleteMultiplesOnAllPlots();
        dataDeleted = true;
        this.textContent = 'Undo Delete';
    } else {
        restoreDeletedData();
        dataDeleted = false;
        this.textContent = 'Delete Multiples';
    }
});

function deleteMultiplesOnAllPlots() {
    // For each plot, delete multiples
    deleteMultiples(plotX, currentLockIndexX, 'X');
    deleteMultiples(plotY, currentLockIndexY, 'Y');
    deleteMultiples(plotZ, currentLockIndexZ, 'Z');

    // Update markers
    updateMarkersAfterDataChange();
}

function deleteMultiples(plot, lockIndex, axisLabel) {
    if (lockIndex === null || lockIndex === undefined || lockIndex <= 0) {
        alert(`Locked index for ${axisLabel} is zero or negative. Cannot delete multiples of zero or negative numbers.`);
        return;
    }

    // Set to store indices of data points to delete
    const indicesToDelete = new Set();

    // Calculate multiples of the lockIndex
    for (let i = lockIndex; i < indices.length; i += lockIndex) {
        // Calculate the range to delete around the index
        const range = Math.floor(valuesX.length * 0.01); // 1% of data length
        const start = Math.max(i - range, 0);
        const end = Math.min(i + range, valuesX.length - 1);
        for (let j = start; j <= end; j++) {
            indicesToDelete.add(j);
        }
    }

    if (indicesToDelete.size === 0) {
        alert(`No multiples found for ${axisLabel} with base index ${lockIndex} to delete.`);
        return;
    }

    // Create new y-data with nulls at deleted indices
    const newY = plot.data[0].y.map((v, i) => indicesToDelete.has(i) ? null : v);

    // Update the plot data
    Plotly.restyle(plot, { y: [newY] }, [0]); // Assuming the main trace is at index 0
}




function restoreDeletedData() {
    // Restore data for each plot
    restorePlotData(plotX, valuesX, originalValuesX);
    restorePlotData(plotY, valuesY, originalValuesY);
    restorePlotData(plotZ, valuesZ, originalValuesZ);

    // Update the plots
    Plotly.restyle(plotX, { y: [valuesX] }, [0]);
    Plotly.restyle(plotY, { y: [valuesY] }, [0]);
    Plotly.restyle(plotZ, { y: [valuesZ] }, [0]);

    // Reset any markers or annotations if necessary
    updateMarkersAfterDataChange();
}


function restorePlotData(plot, dataArray, originalData) {
    // Restore the data array
    dataArray.length = 0;
    Array.prototype.push.apply(dataArray, originalData);
}
function deleteMultiplesOnAllPlots() {
    // For each plot, delete multiples
    deleteMultiples(plotX, currentLockIndexX, 'X');
    deleteMultiples(plotY, currentLockIndexY, 'Y');
    deleteMultiples(plotZ, currentLockIndexZ, 'Z');

    // Update markers
    updateMarkersAfterDataChange();
}


function updateMarkersAfterDataChange() {
    // Recalculate indices
    indices = Array.from(Array(valuesX.length).keys());

    // Update lock markers and local extrema markers for X
    if (currentLockIndexX !== null && currentLockIndexX !== undefined) {
        var localExtremaX = findLocalExtrema(valuesX, currentLockIndexX);
        updateLockMarkersForAxis(plotX, currentLockIndexX, lockedValueX, 'X');
        updateLocalExtremaMarkersForAxis(plotX, localExtremaX, 'X');
    }

    // Update for Y
    if (currentLockIndexY !== null && currentLockIndexY !== undefined) {
        var localExtremaY = findLocalExtrema(valuesY, currentLockIndexY);
        updateLockMarkersForAxis(plotY, currentLockIndexY, lockedValueY, 'Y');
        updateLocalExtremaMarkersForAxis(plotY, localExtremaY, 'Y');
    }

    // Update for Z
    if (currentLockIndexZ !== null && currentLockIndexZ !== undefined) {
        var localExtremaZ = findLocalExtrema(valuesZ, currentLockIndexZ);
        updateLockMarkersForAxis(plotZ, currentLockIndexZ, lockedValueZ, 'Z');
        updateLocalExtremaMarkersForAxis(plotZ, localExtremaZ, 'Z');
    }
}


function updateLockMarkersForAxis(plot, lockIndex, lockedValue, axisLabel) {
    // Update lock marker for the axis
    Plotly.restyle(plot, {
        'x': [[lockIndex]],
        'y': [[lockedValue]]
    }, [5]); // Index 5 is for lockedMarker
}

function updateLocalExtremaMarkersForAxis(plot, extrema, axisLabel) {
    // Update local extrema markers for the axis
    // Local Min Marker at Index 3
    Plotly.restyle(plot, {
        'x': [[extrema.minIndex]],
        'y': [[extrema.minValue]]
    }, [3]);

    // Local Max Marker at Index 4
    Plotly.restyle(plot, {
        'x': [[extrema.maxIndex]],
        'y': [[extrema.maxValue]]
    }, [4]);
}





function restoreDeletedData() {
    // Restore data for each plot
    restorePlotData(plotX, valuesX, originalValuesX);
    restorePlotData(plotY, valuesY, originalValuesY);
    restorePlotData(plotZ, valuesZ, originalValuesZ);

    // Update the plots
    Plotly.restyle(plotX, { y: [valuesX] }, [0]);
    Plotly.restyle(plotY, { y: [valuesY] }, [0]);
    Plotly.restyle(plotZ, { y: [valuesZ] }, [0]);

    // Reset any markers or annotations if necessary
    updateMarkersAfterDataChange();
}



// Key Event Listeners ------------------------------------------------------------------>




document.addEventListener('keydown', function(event) {
    if (event.key === 'ArrowRight') {
        moveLockedValue(1); // Move right
    } else if (event.key === 'ArrowLeft') {
        moveLockedValue(-1); // Move left
    }
});


// moving locked value -------------------------------------------------------------------------->

function moveLockedValue(step) {
    if (currentLockIndexX === null || currentLockIndexX === undefined ||
        currentLockIndexY === null || currentLockIndexY === undefined ||
        currentLockIndexZ === null || currentLockIndexZ === undefined) {
        // No locked value selected yet
        return;
    }

    var newIndexX = currentLockIndexX + step;
    var newIndexY = currentLockIndexY + step;
    var newIndexZ = currentLockIndexZ + step;

    newIndexX = Math.max(1, Math.min(newIndexX, valuesX.length - 1));
    newIndexY = Math.max(1, Math.min(newIndexY, valuesY.length - 1));
    newIndexZ = Math.max(1, Math.min(newIndexZ, valuesZ.length - 1));

    // Update locked indices
    currentLockIndexX = newIndexX;
    currentLockIndexY = newIndexY;
    currentLockIndexZ = newIndexZ;

    // Update locked values
    lockedValueX = valuesX[currentLockIndexX];
    lockedValueY = valuesY[currentLockIndexY];
    lockedValueZ = valuesZ[currentLockIndexZ];

    // Update markers
    updateLockMarkers();

    // Find local extrema
    var localExtremaX = findLocalExtrema(valuesX, currentLockIndexX);
    var localExtremaY = findLocalExtrema(valuesY, currentLockIndexY);
    var localExtremaZ = findLocalExtrema(valuesZ, currentLockIndexZ);

    // Update local extrema markers
    updateLocalExtremaMarkers(localExtremaX, localExtremaY, localExtremaZ);

    // Update displayed values
    updateDisplayedValues(localExtremaX, localExtremaY, localExtremaZ, lockedValueX, lockedValueY, lockedValueZ);

    // Update multiples if active
    if (markMultiplesActive) {
        removeMultiplesMarkers();
        markMultiplesOnAllPlots();
    }
}

function moveLockedValueX(step) {
    if (currentLockIndexX === null || currentLockIndexX === undefined) {
        // No locked value selected for X
        return;
    }

    // Calculate new index for X
    var newIndexX = currentLockIndexX + step;
    newIndexX = Math.max(1, Math.min(newIndexX, valuesX.length - 1));

    // Update locked index and value for X
    currentLockIndexX = newIndexX;
    lockedValueX = valuesX[currentLockIndexX];

    // Update markers
    updateLockMarkers();

    // Find and update local extrema for X
    var localExtremaX = findLocalExtrema(valuesX, currentLockIndexX);
    updateLocalExtremaMarkers(localExtremaX, null, null);
    updateDisplayedValues(localExtremaX, null, null, lockedValueX, null, null);

    // Update multiples if active
    if (markMultiplesActive) {
        removeMultiplesMarkers();
        markMultiplesOnAllPlots();
    }
}

function moveLockedValueY(step) {
    if (currentLockIndexY === null || currentLockIndexY === undefined) {
        // No locked value selected for Y
        return;
    }

    // Calculate new index for Y
    var newIndexY = currentLockIndexY + step;
    newIndexY = Math.max(1, Math.min(newIndexY, valuesY.length - 1));

    // Update locked index and value for Y
    currentLockIndexY = newIndexY;
    lockedValueY = valuesY[currentLockIndexY];

    // Update markers
    updateLockMarkers();

    // Find and update local extrema for Y
    var localExtremaY = findLocalExtrema(valuesY, currentLockIndexY);
    updateLocalExtremaMarkers(null, localExtremaY, null);
    updateDisplayedValues(null, localExtremaY, null, null, lockedValueY, null);

    // Update multiples if active
    if (markMultiplesActive) {
        removeMultiplesMarkers();
        markMultiplesOnAllPlots();
    }
}

function moveLockedValueZ(step) {
    if (currentLockIndexZ === null || currentLockIndexZ === undefined) {
        // No locked value selected for Z
        return;
    }

    // Calculate new index for Z
    var newIndexZ = currentLockIndexZ + step;
    newIndexZ = Math.max(1, Math.min(newIndexZ, valuesZ.length - 1));

    // Update locked index and value for Z
    currentLockIndexZ = newIndexZ;
    lockedValueZ = valuesZ[currentLockIndexZ];

    // Update markers
    updateLockMarkers();

    // Find and update local extrema for Z
    var localExtremaZ = findLocalExtrema(valuesZ, currentLockIndexZ);
    updateLocalExtremaMarkers(null, null, localExtremaZ);
    updateDisplayedValues(null, null, localExtremaZ, null, null, lockedValueZ);

    // Update multiples if active
    if (markMultiplesActive) {
        removeMultiplesMarkers();
        markMultiplesOnAllPlots();
    }
}





//sideband ------------------------------------------------------------------>

document.getElementById('setSidebandBtn').addEventListener('click', function() {
    // Check if any locked value is selected
    if (
        (currentLockIndexX === null || currentLockIndexX === undefined) &&
        (currentLockIndexY === null || currentLockIndexY === undefined) &&
        (currentLockIndexZ === null || currentLockIndexZ === undefined)
    ) {
        alert('Please select a locked value by left-clicking on at least one plot.');
        return;
    }

    // Disable the Set Sideband button
    this.disabled = true;

    // Enable the Undo Sideband button
    document.getElementById('undoSidebandBtn').disabled = false;

    // Mark the sideband on all plots
    markSidebandOnAllPlots();
});


document.getElementById('undoSidebandBtn').addEventListener('click', function() {
    // Enable the Set Sideband button
    document.getElementById('setSidebandBtn').disabled = false;

    // Disable the Undo Sideband button
    this.disabled = true;

    // Remove sideband markers
    removeSidebandMarkers();
});

var sidebandActive = false;
var sidebandTraceIndices = []; // To keep track of sideband traces


function markSidebandOnAllPlots() {
    
    sidebandActive = true;

    // For each plot, mark the sideband if a locked index is set
    if (currentLockIndexX !== null && currentLockIndexX !== undefined) {
        markSideband(plotX, valuesX, currentLockIndexX, 'X');
    }
    if (currentLockIndexY !== null && currentLockIndexY !== undefined) {
        markSideband(plotY, valuesY, currentLockIndexY, 'Y');
    }
    if (currentLockIndexZ !== null && currentLockIndexZ !== undefined) {
        markSideband(plotZ, valuesZ, currentLockIndexZ, 'Z');
    }
}


function markSideband(plot, data, lockIndex, axisLabel) {
    if (lockIndex === null || lockIndex === undefined) {
        return;
    }

    // Step 1: Find the highest peak within the range and move the locked value for the respective axis if needed
    var localMaxData = findLocalMaxima(data, lockIndex);
    var step = localMaxData.index - lockIndex; // Calculate step size (positive or negative)
    
    if (step !== 0) {
        // Depending on the axis, move the lock value accordingly
        if (axisLabel === 'X') {
            moveLockedValueX(step);  // Move the X-axis lock to the highest peak in the region
            lockIndex = currentLockIndexX;
        } else if (axisLabel === 'Y') {
            moveLockedValueY(step);  // Move the Y-axis lock to the highest peak in the region
            lockIndex = currentLockIndexY;
        } else if (axisLabel === 'Z') {
            moveLockedValueZ(step);  // Move the Z-axis lock to the highest peak in the region
            lockIndex = currentLockIndexZ;
        }
    }

    var lockedValue = data[lockIndex];  // Update the locked value

    // Step 2: Calculate the start and end indices of the sideband
    var range = 30;
    var startIndex = Math.max(lockIndex - range, 0);
    var endIndex = Math.min(lockIndex + range, data.length - 1);

    // Step 3: Variables to store the highest points on the left and right side
    var highestLeftY = -Infinity;
    var highestLeftIndex = -1;
    var highestRightY = -Infinity;
    var highestRightIndex = -1;

    // Step 4: Search for the highest local maxima on the left, excluding the locked value
    for (var i = startIndex; i < lockIndex; i++) {
        if (i !== lockIndex && 
            (i === 0 || data[i] > data[i - 1]) &&
            (i === data.length - 1 || data[i] > data[i + 1]) &&
            data[i] < lockedValue &&  // Ensure sideband is smaller than locked value
            data[i] > highestLeftY) {
            highestLeftY = data[i];
            highestLeftIndex = i;
        }
    }

    // Step 5: Search for the highest local maxima on the right, excluding the locked value
    for (var i = lockIndex + 1; i <= endIndex; i++) {
        if (i !== lockIndex && 
            (i === 0 || data[i] > data[i - 1]) &&
            (i === data.length - 1 || data[i] > data[i + 1]) &&
            data[i] < lockedValue &&  // Ensure sideband is smaller than locked value
            data[i] > highestRightY) {
            highestRightY = data[i];
            highestRightIndex = i;
        }
    }

    // Step 6: Create a trace for the sideband peaks (local maxima)
    var sidebandTrace = {
        x: [],
        y: [],
        mode: 'markers',
        name: 'Sideband Peaks',
        marker: { color: 'red', symbol: 'diamond', size: 12 }
    };

    // Only add valid left sideband
    if (highestLeftIndex !== -1) {
        sidebandTrace.x.push(highestLeftIndex);
        sidebandTrace.y.push(highestLeftY);
    }

    // Only add valid right sideband
    if (highestRightIndex !== -1) {
        sidebandTrace.x.push(highestRightIndex);
        sidebandTrace.y.push(highestRightY);
    }

    // If no valid sideband peaks were found, display an alert
    if (sidebandTrace.x.length === 0) {
        alert(`No valid sideband peaks found for ${axisLabel}.`);
        return;
    }

    // Step 7: Remove any existing sideband traces before adding the new ones
    if (plot.sidebandTraceIndex !== undefined) {
        Plotly.deleteTraces(plot, plot.sidebandTraceIndex);
    }

    // Step 8: Add the new sideband trace to the plot
    Plotly.addTraces(plot, sidebandTrace);
    plot.sidebandTraceIndex = plot.data.length - 1;
}


function adjustLockedValue(data, lockIndex) {
    var maxData = findLocalMaxima(data, lockIndex);
    if (maxData.value > data[lockIndex]) {
        lockIndex = maxData.index;  // Move lock to the highest point in range
    }
    return lockIndex;  // Return the updated lock index
}






function removeSidebandMarkers() {
    sidebandActive = false;

    removeSidebandFromPlot(plotX);
    removeSidebandFromPlot(plotY);
    removeSidebandFromPlot(plotZ);
}

function removeSidebandFromPlot(plot) {
    if (plot.sidebandTraceIndex !== undefined) {
        Plotly.deleteTraces(plot, plot.sidebandTraceIndex);
        plot.sidebandTraceIndex = undefined;
    }
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

document.getElementById('goBack').addEventListener('click', function () {
    window.history.back();
});
    

//OVL
// Global variables
var ovlX = 0;
var ovlY = 0;
var ovlZ = 0;
var f1 = 0;
var f2 = 0;
var deltaF = 0;

// Add event listener to the "Find OVL" button
document.getElementById('findOVLBtn').addEventListener('click', function() {
    // Get the input values and store them in global variables
    f1 = parseInt(document.getElementById('f1Input').value);
    f2 = parseInt(document.getElementById('f2Input').value);
    deltaF = parseInt(document.getElementById('deltaFInput').value);

    // Validate the inputs
    if (isNaN(f1) || isNaN(f2) || isNaN(deltaF)) {
        alert('Please enter valid numeric values for f1, f2, and delta f.');
        return;
    }
    if (f1 < 1 || f2 < 1 || deltaF < 1) {
        alert('Please enter positive integer values greater than zero for f1, f2, and delta f.');
        return;
    }
    if (f1 > f2) {
        alert('f1 must be less than or equal to f2.');
        return;
    }
    if (f2 > valuesX.length) {
        alert('f2 exceeds the data range.');
        return;
    }

    // Compute OVL for X and store in global variable
    ovlX = computeOVL(valuesX, f1, f2, deltaF);
    // Compute OVL for Y and store in global variable
    ovlY = computeOVL(valuesY, f1, f2, deltaF);
    // Compute OVL for Z and store in global variable
    ovlZ = computeOVL(valuesZ, f1, f2, deltaF);

    // Call the existing updateDisplayedValues function
    updateDisplayedValues(initialExtremaX, initialExtremaY, initialExtremaZ, lockedValueX, lockedValueY, lockedValueZ);
});

// Function to compute OVL
function computeOVL(values, f1, f2, deltaF) {
    var sumSquares = 0;

    // Debugging information
    console.log(`Computing OVL for f1 = ${f1}, f2 = ${f2}, deltaF = ${deltaF}`);
    console.log(`Y-axis values for x-axis multiples of deltaF:`);

    for (var i = f1; i <= f2; i++) {
        // Select only indices that are multiples of deltaF
        if (i % deltaF === 0) {
            var index = i; // Adjust for 0-based array index
            if (index >= 0 && index < values.length) {
                var amplitude = values[index];
                sumSquares += amplitude * amplitude;

                // Log the index (x-axis) and amplitude (y-axis) for debugging
                console.log(`Index (X-axis): ${i}, Amplitude (Y-axis): ${amplitude}`);
            }
        }
    }

    // Final OVL value
    var ovlValue = Math.sqrt(sumSquares);

    // Debugging - display computed OVL
    console.log(`Computed OVL: ${ovlValue}`);

    return ovlValue;
}










</script>

@endsection
