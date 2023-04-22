import { memo } from "react";

function Autocomplete(props) {
console.debug('Autocomplete');//mmmyyy
    return (
        <div id="autocomplete">
            {props.autocomplete}
        </div>
    );
}

export default memo(Autocomplete);
