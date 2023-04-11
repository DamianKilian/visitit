import Autocomplete from "./Autocomplete";

function SearchBar(props) {
console.debug('SearchBar');//mmmyyy
    return (
        <div id="search-bar">
            <input className="form-control" onChange={props.onChange} onKeyDown={props.onConfirm} value={props.searchBarValue}/>
            <Autocomplete autocomplete={props.autocomplete}/>
        </div>
    );
}

export default SearchBar;
