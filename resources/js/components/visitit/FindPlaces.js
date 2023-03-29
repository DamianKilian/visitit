import React from "react";
import ReactDOM from "react-dom/client";

import Find from "./findPlaces/Find";

function FindPlaces() {
    return (
        <Find />
    );
}

export default FindPlaces;

var reactElement = document.getElementById("find-places");
if (reactElement) {
    ReactDOM.createRoot(reactElement).render(<FindPlaces />);
}
