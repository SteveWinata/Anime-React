import { Link } from "react-router-dom";

const NotFound = () => {
    return ( 
        <div className="text-center">
        <h2 className="text-3xl font-semibold mb-2">Sorry</h2>
        <p>What you have searching for is not here</p>
        <Link to="/" className="bold text-primary text-decoration-none">
            Go back to the blog...
        </Link>
        </div>
     );
}
 
export default NotFound;