import { BrowserRouter as Router, Routes, Route } from "react-router-dom";

import Header from "./components/layouts/Header";
import ChatLayout from "./components/layouts/ChatLayout";

function App() {
  return (
    <Router>
      <Header />
      <Routes>
        <Route
            exact
            path="/"
            element={
              //<WithPrivateRoute>
                <ChatLayout />
              //</WithPrivateRoute>
            }
          />
      </Routes>
    </Router>
  );
}

export default App;