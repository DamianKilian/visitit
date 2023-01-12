import React from "react";
import ReactDOM from "react-dom";
import DestroyRestoreButton from "./removalButtons/DestroyRestoreButton";

function RemovalButtons(props) {
    return (
        <>
            <DestroyRestoreButton {...props}/>
        </>
    );
}

export default RemovalButtons;

var reactElements = document.getElementsByClassName("react-delete-button");
if (reactElements) {
    [...reactElements].forEach((reactElement) => {
        ReactDOM.render(<RemovalButtons {...reactElement.dataset} />, reactElement);
    });
}
