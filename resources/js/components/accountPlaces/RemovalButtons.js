import React from "react";
import ReactDOM from "react-dom/client";
import DestroyRestoreButton from "./removalButtons/DestroyRestoreButton";
import ForceDelete from "./removalButtons/ForceDelete";

function RemovalButtons(props) {
    const place = placesData[props.id];
    return (
        <>
            <DestroyRestoreButton {...props} />{" "}
            {place.trashed && <ForceDelete {...props} />}
        </>
    );
}

export default RemovalButtons;

var reactElements = document.getElementsByClassName("react-delete-button");
if (reactElements) {
    [...reactElements].forEach((reactElement) => {
        ReactDOM.createRoot(reactElement).render(
            <RemovalButtons {...reactElement.dataset} />
        );
    });
}
