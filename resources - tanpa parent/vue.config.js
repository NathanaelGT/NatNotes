module.exports = {
  publicPath: process.env.NODE_ENV === 'production' ? 'dist/' : './',
  outputDir: '../dist - tanpa parent',
  indexPath: '../index.htm',
  devServer: {
    public: 'localhost:8080',
    host: 'localhost',
    port: 8080
  }
}