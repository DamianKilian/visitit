import Autocomplete from "./Autocomplete";

function SearchBar(props) {
    console.debug("SearchBar"); //mmmyyy
    var faClass = "fa-keyboard";
    var inputClass = "";
    if (0 === props.resultsNum) {
        faClass = "fa-xmark text-bg-danger";
        inputClass = "link-danger";
    } else if (0 < props.resultsNum) {
        faClass = "fa-check text-bg-success";
        inputClass = "link-success";
    }
    return (
        <div id="search-bar">
            <div className="input-group">
                <input
                    className={"form-control " + inputClass}
                    onChange={props.onChange}
                    onKeyDown={props.onConfirm}
                    value={props.searchBarValue}
                    ref={props.reference}
                />
                <i
                    className={"input-group-text fa-solid " + faClass}
                    id="typing"
                > {props.resultsNum}</i>
                <button
                    onClick={props.onConfirm}
                    id="find-btn"
                    className="btn btn-outline-secondary"
                >
                    Find <i className="fa-solid fa-arrow-right"></i>
                </button>
            </div>
            <Autocomplete autocomplete={props.autocomplete} />
        </div>
    );
}

export default SearchBar;
