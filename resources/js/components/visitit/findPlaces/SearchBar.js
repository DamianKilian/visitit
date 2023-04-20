import Autocomplete from "./Autocomplete";

function SearchBar(props) {
    console.debug("SearchBar"); //mmmyyy
    return (
        <div id="search-bar">
            <div className="input-group">
                <input
                    className="form-control"
                    onChange={props.onChange}
                    onKeyDown={props.onConfirm}
                    value={props.searchBarValue}
                />
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
