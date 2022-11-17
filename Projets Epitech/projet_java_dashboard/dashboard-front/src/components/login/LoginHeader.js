import { Image } from "@mantine/core";

function LoginHeader() {
  return (
    <div style={{
        display: "flex", 
        flexDirection: "column", 
        alignItems: "center"
    }}>
      <div style={{width: 64}}>
        <Image
          radius="md"
          src="dashboard-logo.png"
          alt="Developer board logo"
        />
      </div>
      <h1 style={{marginTop: 5}}>
        Developer Board
      </h1>
      <p style={{marginTop: 10}}>
        Your most favorite tools in one place.
      </p>
    </div>
  );
}

export default LoginHeader;